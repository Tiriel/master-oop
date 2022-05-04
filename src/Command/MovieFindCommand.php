<?php

namespace App\Command;

use App\Consumer\OMDbApiConsumer;
use App\Provider\MovieProvider;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:movie:find',
    description: 'Find a movie by title or OMDb ID',
)]
class MovieFindCommand extends Command
{
    private const TYPES = [
        'id' => OMDbApiConsumer::MODE_ID,
        'title' => OMDbApiConsumer::MODE_TITLE,
    ];

    public function __construct(private MovieProvider $provider, string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setAliases(['movie:find'])
            ->addArgument('type', InputArgument::OPTIONAL, 'The type of search, "title" or "id"')
            ->addArgument('value', InputArgument::OPTIONAL, 'The title or ID to search.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $type = $input->getArgument('type');
        while (!array_key_exists($type, self::TYPES)) {
            $type = $io->ask('What is the type of the data used for the search? ("title" or "id")');
        }

        $value = $input->getArgument('value');
        while (empty($value)) {
            $value = $io->ask(sprintf('What is the %s you want to search?', $type));
        }

        $io->text(sprintf("Looking for a movie with %s %s", $type, $value));

        try {
            $movie = $this->provider->getOneMovie(self::TYPES[$type], $value);
        } catch (\Exception) {
            $io->error('No movie found.');

            return Command::FAILURE;
        }

        $io->success('Found a movie!');
        $io->table(['OMDb ID', 'title', 'Rated'], [
            [$movie->getOmdbId(), $movie->getTitle(), $movie->getRated()],
        ]);

        return Command::SUCCESS;
    }
}

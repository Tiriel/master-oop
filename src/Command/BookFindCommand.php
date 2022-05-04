<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:book:find',
    description: 'Find a book by ISBN.',
)]
class BookFindCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setAliases(['book:find'])
            ->addArgument('isbn', InputArgument::REQUIRED, 'ISBN code to retrieve a book')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $output->writeln('ISBN: ' . $input->hasArgument('isbn'));
        
        return Command::SUCCESS;
    }
}

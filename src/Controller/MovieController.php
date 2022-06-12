<?php

namespace App\Controller;

use App\Consumer\OMDbApiConsumer;
use App\Security\Voter\MovieRatingVoter;
use App\Transformer\MovieTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie', name: 'app_movie_')]
class MovieController extends AbstractController
{
    #[Route('', name: 'home')]
    public function index()
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    #[Route('/{title}', name: 'details')]
    public function details(string $title): Response
    {
        $data = (new OMDbApiConsumer())->consume(OMDbApiConsumer::MODE_TITLE, $title);
        $movie = (new MovieTransformer())->arrayToMovie($data);
        $this->denyAccessUnlessGranted(MovieRatingVoter::RATING, $movie);

        return $this->render('movie/details.html.twig', [
            'movie' => $movie,
        ]);
    }
}

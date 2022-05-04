<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Provider\MovieProvider;
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
    public function details(string $title, MovieProvider $provider): Response
    {
        $movie = $provider->getByTitle($title);

        return $this->render('movie/details.html.twig', [
            'movie' => $movie,
        ]);
    }
}

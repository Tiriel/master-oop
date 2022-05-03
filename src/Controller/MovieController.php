<?php

namespace App\Controller;

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

    #[Route('/{id<\d+>}', name: 'details')]
    public function details(int $id): Response
    {
        $movie = [
            'title' => 'Star Wars: A New Hope',
            'released' => new \DateTime('1977-05-25'),
            'genre' => ['Action', 'Adventure', 'Fantasy'],
        ];

        return $this->render('movie/details.html.twig', [
            'movie' => $movie,
        ]);
    }
}

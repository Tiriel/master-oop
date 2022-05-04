<?php

namespace App\Controller;

use App\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book', name: 'app_book_')]
class BookController extends AbstractController
{
    #[Route('/{page<\d+>?1}', name: 'index')]
    public function index(int $page): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        $form = $this->createForm(BookType::class);

        return $this->renderForm('book/create.html.twig', [
            'book_form' => $form,
        ]);
    }
}

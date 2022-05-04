<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MovieRepository $repository): Response
    {
        $movies = $repository->findBy([], null, 6);

        return $this->render('default/index.html.twig', [
            'movies' => $movies,
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        $form = $this->createForm(ContactType::class);

        return $this->renderForm('default/contact.html.twig', [
            'contact_form' => $form
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilInscritController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil_inscrit')]
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->render('accueil_inscrit/index.html.twig', [
                'user' => $this->getUser()
            ]);
        }
        return $this->render('accueil_inscrit/index.html.twig', []);
    }
}

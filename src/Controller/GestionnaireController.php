<?php

namespace App\Controller;

use App\Entity\Gestionnaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionnaireController extends AbstractController
{
    #[Route('/gestion', name: 'app_gestionnaire')]
    public function index(): Response
    {

        if (!$this->getUser() instanceof Gestionnaire) {
            return $this->redirectToRoute('app_index');
        }


        return $this->render('gestionnaire/index.html.twig', [
            'controller_name' => 'GestionnaireController',
        ]);
    }
}

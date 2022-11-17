<?php

namespace App\Controller;

use App\Entity\Enfant;
use App\Entity\Responsable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionController extends AbstractController
{
    #[Route('/gestion', name: 'app_gestion')]
    public function index(): Response
    {
        return $this->render('gestion/index.html.twig', [
            'controller_name' => 'GestionController',
        ]);
    }


    #[Route('/gestion/listusers', name: 'app_gestion')]
    public function listusers(EntityManagerInterface $entityManager): Response
    {

        $responsables =  $entityManager->getRepository(Responsable::class)->findAll();
        $enfants = $entityManager->getRepository(Enfant::class)->findAll();
        return $this->render('gestion/listusers.html.twig', [
            'responsables' => $responsables,
            'enfants' => $enfants
        ]);
    }
}

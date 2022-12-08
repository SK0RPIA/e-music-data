<?php

namespace App\Controller;

use App\Entity\Cours;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->render('index/index.html.twig', [
                'user' => $this->getUser()
            ]);
        }
        return $this->render('index/index.html.twig', []);
    }

    #[Route('/index/cours', name: 'app_cours')]
    public function coursAction(ManagerRegistry $doctrine): Response
    {
        $cours = $doctrine->getRepository(Cours::class)->findAll();
        return $this->render('index/cours.html.twig', [
            'controller_name' => 'IndexController', 'cours' => $cours
        ]);
    }
}

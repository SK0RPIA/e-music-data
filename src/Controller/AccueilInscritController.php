<?php

namespace App\Controller;

use App\Entity\Responsable;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilInscritController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil_inscrit')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_index', []);
        }

        if ($this->getUser() instanceof Responsable) {
            return $this->render('accueil_inscrit/index.html.twig', [
                'user' => $this->getUser(),
                'isresponsable' => true,
            ]);
        } else {
            return $this->render('accueil_inscrit/index.html.twig', [
                'user' => $this->getUser(),
            ]);
        }
    }




    #[Route('/accueil/delete-my-account', name: 'app_delaccount')]
    public function delete(EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_index');
        }

        $user = $entityManager->getRepository(User::class)->find($this->getUser());

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->render('index/index.html.twig', ['message' => 'Compte supprimer !']);
    }
}

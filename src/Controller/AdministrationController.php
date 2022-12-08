<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends AbstractController
{
    #[Route('/administration/view-users', name: 'app_administrationviewusers')]
    public function index(EntityManagerInterface $entity): Response
    {
        $users = $entity->getRepository(User::class)->findAll();

        return $this->render('administration/viewusers.html.twig', [
            'users'=>$users
        ]);
    }
}

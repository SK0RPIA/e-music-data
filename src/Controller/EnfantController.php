<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnfantController extends AbstractController
{
    #[Route('/enfant/add', name: 'app_addenfant')]
    public function add(Request $request, EntityManagerInterface $entitymanager): Response
    {

        if(!$this->getUser()){
            return $this->redirect('app_index');
        }
        $user = $this->getUser();

        $enfants = $user->getEnfants();

        

        return $this->render('enfant/add.html.twig', [
            'user' => $user,
            'enfants' => $enfants,

        ]);
    }
}

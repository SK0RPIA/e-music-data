<?php

namespace App\Controller;

use App\Entity\Responsable;
use App\Form\CreateResponsableType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResponsableController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('responsable/index.html.twig', [
            'controller_name' => 'ResponsableController',
        ]);
    }

    #[Route('/register/responsable', name: 'app_addresponsable')]
    public function addResponsable(Request $request, ManagerRegistry $doctrine)
    {

        $responsable = new Responsable();
        $form = $this->createForm(CreateResponsableType::class, $responsable);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $responsable = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($responsable);
            $entityManager->flush();
            return $this->render('responsable/form.html.twig', ['responsable' => $responsable,]);
        } else {
            return $this->render('responsable/form.html.twig', array('form' => $form->createView(),));
        }
    }
}

<?php

namespace App\Controller;

use App\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CoursType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class CoursController extends AbstractController
{
    #[Route('/cours', name: 'app_cours')]
    public function index(): Response
    {
        return $this->render('cours/ajouter.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }


    #[Route('/ajoutercours', name: 'app_cours')]
    public function ajouterCours(Request $request, ManagerRegistry $doctrine)
    {

        $cours = new cours();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cours = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($cours);
            $entityManager->flush();
            return $this->render('cours/consulter.html.twig', ['cours' => $cours,]);
        } else {
            return $this->render('cours/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }

    public function consulterCours(ManagerRegistry $doctrine,$idCours): Response
    {
        $cours = $doctrine ->getRepository (Cours :: class) -> find ($idCours);
        return $this->render('cours/consulter.html.twig',['cours' => $cours,]);
    }
    public function listerCours(ManagerRegistry $doctrine){
        $repository =  $doctrine ->getRepository (Cours::class);
        $cours = $repository->findAll();
        return $this->render('cours/listerCours.html.twig', [
        'cours' => $cours]);
    
        }
}

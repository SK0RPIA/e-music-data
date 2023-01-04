<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Responsable;
use App\Form\CreateResponsableType;

class GestionnaireController extends AbstractController
{
    #[Route('/gestionnaire', name: 'app_gestionnaire')]
    public function index(): Response
    {
        return $this->render('gestionnaire/index.html.twig', [
            'controller_name' => 'GestionnaireController',
        ]);
    }

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

        public function calculateCourseDuration(Cours $cours)
        {
            $startTimestamp = strtotime($cours->getStartTime());
            $endTimestamp = strtotime($cours->getEndTime());
            $duration = $endTimestamp - $startTimestamp;
        
            $cours->setDuration($duration);
        
            return $duration;
        }
}

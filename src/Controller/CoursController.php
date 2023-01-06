<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Enfant;
use App\Entity\User;
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

    #[Route('/add/cours', name: 'add_cours')]
    public function addCours(Request $request, ManagerRegistry $entityManager): Response
    {


        $cours = $entityManager->getRepository(Cours::class)->findAll();


        return $this->render('cours/add_cours.html.twig', [
            'cours' => $cours
        ]);
    }

    #[Route('/add/cours/users', name: 'add_cours_users')]
    public function addCoursusers(Request $request, ManagerRegistry $entityManager): Response
    {

        $idcour = $request->query->get('cours');


        $cour = $entityManager->getRepository(Cours::class)->find(['id' => intval($idcour)]);

        $users = [];
        $user = $this->getUser();


        array_push($users, $user);


        $enfants = $entityManager->getRepository(Enfant::class)->findBy(['responsable' => 1]);

        if (sizeof($enfants) > 0) {
            foreach ($enfants as $kid) {
                array_push($users, $kid);
            }
        }



        return $this->render('cours/add_cours_users.html.twig', [
            'cour' => $cour,
            'users' => $users
        ]);
    }


    #[Route('/add/cours/confirm', name: 'add_cours_confirm')]
    public function addCoursConfirm(Request $request, ManagerRegistry $entityManager): Response
    {



        $data = $request->query->all();

        $courid = $data['cours'];
        unset($data['cours']);

        $users = [];

        dd($data);

        foreach ($data as $user) {
            $user = $entityManager->getRepository(User::class)->findBy(['email' => key($data)]);

            if (sizeof($user) > 0) {
                array_merge($users, $user);
            }
        }

        $cour = $entityManager->getRepository(Cours::class)->find(intval($courid));


        foreach ($users as $user) {
            $cour->addParticipant($user);
        }

        return $this->redirectToRoute('add_cours');
    }




    public function consulterCours(ManagerRegistry $doctrine, $idCours): Response
    {
        $cours = $doctrine->getRepository(Cours::class)->find($idCours);
        return $this->render('cours/consulter.html.twig', ['cours' => $cours,]);
    }
}

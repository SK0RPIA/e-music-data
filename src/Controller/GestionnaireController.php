<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Enfant;
use App\Entity\Gestionnaire;
use App\Entity\Responsable;
use App\Entity\User;
use App\Form\AddCoursToUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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



    #[Route('/gestion/view-users', name: 'app_gestionnaireviewusers')]
    public function viewUsers(EntityManagerInterface $entity): Response
    {
        if (!$this->getUser() instanceof Gestionnaire) {
            return $this->redirectToRoute('app_index');
        }
        $users =  $entity->getRepository(Responsable::class)->findAll();
        foreach ($entity->getRepository(Enfant::class)->findAll() as $kid) {
            array_push($users, $kid);
        }

        return $this->render('gestionnaire/viewusers.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/gestion/view-user', name: 'app_gestionnaireviewuser')]
    public function viewUser(Request $request, EntityManagerInterface $entity): Response
    {
        if (!$this->getUser() instanceof Gestionnaire) {
            return $this->redirectToRoute('app_index');
        }

        $mail = $request->query->get('email');

        $users =  $entity->getRepository(User::class)->findBy(['email' => $mail]);
        if (sizeof($users) < 1) {
            return $this->redirectToRoute('app_index');
        }
        $user = $users[0];


        $form = $this->createForm(AddCoursToUserType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cours = $form->getData()['cours'];

            $user->addCour($cours);



            $entity->persist($user);
            $entity->flush();
            return $this->render('gestionnaire/viewuser.html.twig', [
                'user' => $user,
                'cours' => $user->getCours(),
                'message' => 'Cours ajouter',
                'form' => $form->createView()
            ]);
        }


        return $this->render('gestionnaire/viewuser.html.twig', [
            'user' => $user,
            'cours' => $user->getCours(),
            'form' => $form->createView()

        ]);
    }

    #[Route('/gestion/del-cour-user', name: 'app_gestionnairedel-cours-user')]
    public function delCoursUser(Request $request, EntityManagerInterface $entity): Response
    {
        if (!$this->getUser() instanceof Gestionnaire) {
            return $this->redirectToRoute('app_index');
        }

        $mail = $request->query->get('email');
        $cours = $request->query->get('courid');

        $users =  $entity->getRepository(User::class)->findBy(['email' => $mail]);
        if (sizeof($users) < 1) {
            return $this->redirectToRoute('app_index');
        }
        $user = $users[0];

        $cour =  $entity->getRepository(Cours::class)->find($cours);

        $user->removeCour($cour);


        $entity->persist($user);
        $entity->flush();


        $form = $this->createForm(AddCoursToUserType::class);
        $form->handleRequest($request);


        return $this->redirect('/gestion/view-user?email='. $user->getEmail());
    }
}

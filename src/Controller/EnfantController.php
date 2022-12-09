<?php

namespace App\Controller;

use App\Entity\Enfant;
use App\Form\EnfantFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class EnfantController extends AbstractController
{
    #[Route('/enfant/list', name: 'app_listenfant')]
    public function list(Request $request, EntityManagerInterface $entitymanager): Response
    {

        if (!$this->getUser()) {
            return $this->redirect('app_index');
        }
        $user = $this->getUser();

        $enfants = $user->getEnfants();


        return $this->render('enfant/list.html.twig', [
            'user' => $user,
            'enfants' => $enfants,

        ]);
    }




    #[Route('/enfant/add', name: 'app_addenfant')]
    public function add(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        if (!$this->getUser()) {
            return $this->redirect('app_index');
        }
        $user = $this->getUser();

        $enfant = new Enfant();
        $form = $this->createForm(EnfantFormType::class, $enfant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            if (!$user->isValide()) {
                return $this->render('enfant/add.html.twig', [
                    'user' => $user,
                    'form' => $form->createView(),
                    'message' => "Le gestionnaire ne vous a pas valider !"

                ]);
            }
            // encode the plain password
            $enfant->setPassword(
                $userPasswordHasher->hashPassword(
                    $enfant,
                    $form->get('plainPassword')->getData()
                )
            );

            $enfant->setResponsable($user);

            $entityManager->persist($enfant);
            $entityManager->flush();            // generate a signed url and email it to the user
            //  $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            //      (new TemplatedEmail())
            //          ->from(new Address('account-validation@e-music.info', 'E-Music'))
            //          ->to($user->getEmail())
            //          ->subject('Please Confirm your Email')
            //          ->htmlTemplate('registration/confirmation_email.html.twig')
            //  );
            // do anything else you need here, like send an email



            //TODO -> a changer par l'index // accueil
            return $this->redirectToRoute('app_listenfant');
        }

        return $this->render('enfant/add.html.twig', [
            'user' => $user,
            'form' => $form->createView(),

        ]);
    }
}

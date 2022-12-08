<?php

namespace App\Controller;

use App\Entity\Responsable;
use App\Form\ResponsableFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = new Responsable();
        $form = $this->createForm(ResponsableFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
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
            return $this->redirectToRoute('app_login');
        }



        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

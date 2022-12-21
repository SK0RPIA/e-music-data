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

     #[Route('/gestionnaire/create-account', name:'create_account')]
    
   public function createAccount(Request $request)
   {
       $form = $this->createForm(AccountType::class);
   
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $data = $form->getData();
           
       }
   
       return $this->render('gestionnaire/create_account.html.twig', [
           'form' => $form->createView(),
       ]);
       $account = new Account();
$account->setEmail($data['email']);
$account->setPassword($data['password']);
// ... affectation des autres champs du formulaire à l'objet Account

$accountRepository->save($account);
   }
}

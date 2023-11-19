<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\Contact1Type;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $contact->setContUser($this->getUser());

        $form = $this->createForm(Contact1Type::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($contact);
            $entityManager->flush();


            return $this->redirectToRoute('app_succes');

        }

        return $this->renderForm('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'contact' => $contact,
            'formulaire' => $form
        ]);
    }

    #[Route('/contact/succes', name: 'app_succes')]
    public function sucess(): Response
    {
        $user = $this->getUser(); 
        if ($user) {
            $library = $user->getLibrary();
        } else {
            $library = null; 
        }
        return $this->render('succes/index.html.twig', [
            'controller_name' => 'SuccesController',
            'library' => $library
        ]);
    }
}

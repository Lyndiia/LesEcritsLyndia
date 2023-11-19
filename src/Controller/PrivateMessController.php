<?php

namespace App\Controller;

use App\Entity\PrivateMess;
use App\Form\PrivateMessType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class PrivateMessController extends AbstractController
{
    #[Route('/private/mess', name: 'app_private_mess')]
    public function index(): Response
    {
        return $this->render('private_mess/index.html.twig', [
            'controller_name' => 'PrivateMessController',
        ]);
    }

    #[Route('/send', name:"app_send")]
    public function send(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new PrivateMess();
        $form = $this->createForm(PrivateMessType::class, $message);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $message->setSender($this->getUser());

            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash("message", "Message envoyé avec succès!");
            return $this->redirectToRoute('app_private_mess');
        }

        return $this->render('private_mess/send.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/received', name: 'app_received')]
    public function received(): Response
    {
        return $this->render('private_mess/received.html.twig');
    }

    #[Route('/read/{id}', name: 'app_read')]
    public function read(PrivateMess $message, EntityManagerInterface $entityManager): Response
    {
        $message->setIsRead(true);

        $entityManager->persist($message);
        $entityManager->flush();

        return $this->render('private_mess/read.html.twig', compact("message"));
    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(PrivateMess $message, EntityManagerInterface $entityManager): Response
    {

        $entityManager->remove($message);
        $entityManager->flush();

        return $this->redirectToRoute("app_received");
    }

    #[Route('/sent', name: 'app_sent')]
    public function sent(): Response
    {
        return $this->render('private_mess/sent.html.twig');
    }
    
}

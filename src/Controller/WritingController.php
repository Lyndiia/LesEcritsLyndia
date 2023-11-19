<?php

namespace App\Controller;

use App\Entity\Writing;
use App\Entity\Article;
use App\Form\Writing1Type;
use App\Repository\WritingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/writing')]
#[IsGranted('ROLE_USER')]
class WritingController extends AbstractController
{

    #[Route('{articleId}/new', name: 'app_writing_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $articleId): Response
    {
        $article = $entityManager->getRepository(Article::class)->find($articleId);
        $writing = new Writing();
        $writing->setUserSend($this->getUser());
        $writing->setArticle($article);
        $form = $this->createForm(Writing1Type::class, $writing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($writing);
            $entityManager->flush();

            return $this->redirectToRoute('app_writing_show', ['id' => $writing->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('writing/new.html.twig', [
            'writing' => $writing,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_writing_show', methods: ['GET'])]
    public function show(Writing $writing): Response
    {
        return $this->render('writing/show.html.twig', [
            'writing' => $writing,
        ]);
    }
}

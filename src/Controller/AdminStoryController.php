<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/story')]
#[IsGranted('ROLE_ADMIN')]
class AdminStoryController extends AbstractController
{
    #[Route('/', name: 'app_admin_story_index', methods: ['GET'])]
    public function index(StoryRepository $storyRepository): Response
    {
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        return $this->render('admin_story/index.html.twig', [
            'stories' => $storyRepository->findAll(),
            'library' => $library
        ]);
    }

    #[Route('/new', name: 'app_admin_story_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $story = new Story();
        $form = $this->createForm(StoryType::class, $story);
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('story_pic')->getData();

            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );

                $story->setStoryPic($fileName);
            }

            $entityManager->persist($story);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_story_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_story/new.html.twig', [
            'story' => $story,
            'form' => $form,
            'library' => $library
        ]);
    }

    #[Route('/{id}', name: 'app_admin_story_show', methods: ['GET'])]
    public function show(Story $story): Response
    {
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        return $this->render('admin_story/show.html.twig', [
            'story' => $story,
            'library' => $library
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_story_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Story $story, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StoryType::class, $story);
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('story_pic')->getData();

            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );

                $story->setStoryPic($fileName);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_story_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_story/edit.html.twig', [
            'story' => $story,
            'form' => $form,
            'library' => $library
        ]);
    }

    #[Route('/{id}', name: 'app_admin_story_delete', methods: ['POST'])]
    public function delete(Request $request, Story $story, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$story->getId(), $request->request->get('_token'))) {
            $entityManager->remove($story);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_story_index', [], Response::HTTP_SEE_OTHER);
    }
}

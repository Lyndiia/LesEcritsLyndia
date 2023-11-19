<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Form\ChapterType;
use App\Repository\ChapterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/admin/chapter')]
#[IsGranted('ROLE_ADMIN')]
class AdminChapterController extends AbstractController
{
    #[Route('/', name: 'app_admin_chapter_index', methods: ['GET'])]
    public function index(ChapterRepository $chapterRepository): Response
    {   
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        return $this->render('admin_chapter/index.html.twig', [
            'chapters' => $chapterRepository->findAll(),
            'library' => $library
        ]);
    }

    #[Route('/new', name: 'app_admin_chapter_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chapter = new Chapter();
        $form = $this->createForm(ChapterType::class, $chapter);
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chapter);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_chapter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_chapter/new.html.twig', [
            'chapter' => $chapter,
            'form' => $form,
            'library' => $library
        ]);
    }

    #[Route('/{id}', name: 'app_admin_chapter_show', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function show(Chapter $chapter): Response
    {
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        return $this->render('admin_chapter/show.html.twig', [
            'chapter' => $chapter,
            'library' => $library
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_chapter_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Chapter $chapter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChapterType::class, $chapter);
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_chapter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_chapter/edit.html.twig', [
            'chapter' => $chapter,
            'form' => $form,
            'library' => $library
        ]);
    }

    #[Route('/{id}', name: 'app_admin_chapter_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Chapter $chapter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chapter->getId(), $request->request->get('_token'))) {
            $entityManager->remove($chapter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_chapter_index', [], Response::HTTP_SEE_OTHER);
    }
}

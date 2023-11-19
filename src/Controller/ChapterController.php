<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Form\Chapter1Type;
use App\Repository\ChapterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chapter')]
class ChapterController extends AbstractController
{
    #[Route('/', name: 'app_chapter_index', methods: ['GET'])]
    public function index(ChapterRepository $chapterRepository): Response
    {
        return $this->render('chapter/index.html.twig', [
            'chapters' => $chapterRepository->findAll(),
        ]);
    }


    #[Route('/{id}', name: 'app_chapter_show', methods: ['GET'])]
    public function show(Chapter $chapter): Response
    {
        $story = $chapter->getStory();
        $chapters = $story->getChapters();
        $user = $this->getUser(); 
        if ($user) {
            $library = $user->getLibrary();
        } else {
            $library = null; 
        }
        
        return $this->render('chapter/show.html.twig', [
            'chapter' => $chapter,
            'story' => $story,
            'chapters' => $chapters,
            'library' => $library
        ]);
    }
}

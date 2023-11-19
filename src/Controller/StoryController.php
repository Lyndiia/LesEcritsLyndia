<?php

namespace App\Controller;

use App\Entity\Library;
use App\Entity\Story;
use App\Form\Story1Type;
use App\Repository\StoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/story')]
class StoryController extends AbstractController
{
    #[Route('/', name: 'app_story_index', methods: ['GET'])]
    public function index(StoryRepository $storyRepository): Response
    {
        return $this->render('story/index.html.twig', [
            'stories' => $storyRepository->findAll(),
        ]);
    }

   

    #[Route('/{id}', name: 'app_story_show', methods: ['GET'])]
    public function show(Story $story): Response
    {
        $chapters = $story->getChapters();
        $user = $this->getUser(); 
        if ($user) {
            $library = $user->getLibrary();
        } else {
            $library = null; 
        }
        
        return $this->render('story/show.html.twig', [
            'story' => $story,
            'chapters' => $chapters,
            'library' => $library
        ]);
    }

    #[Route('/add-to-library/{storyId}', name: 'add_to_library', methods: ['GET'])]
    public function addToLibrary($storyId,EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();  
    
        if ($user) {
            $story = $entityManager->getRepository(Story::class)->find($storyId);
            
            if ($story) {
                $user->getLibrary()->addLibRead($story);
    
                $entityManager->persist($user);
                $entityManager->flush();
    
                return $this->redirectToRoute('app_story_show', ['id' => $storyId]);
            }
        }                    
        return new Response('Erreur lors de l\'ajout à la bibliothèque');
    }
}

<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\Article2Type;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/concours')]
class ConcoursController extends AbstractController
{
    #[Route('/', name: 'app_concours_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        $user = $this->getUser(); 
        if ($user) {
            $library = $user->getLibrary();
        } else {
            $library = null; 
        }

        return $this->render('concours/index.html.twig', [
            'articles' => $articleRepository->findBy(['tag' => 'Concours']),
            'library' => $library,
        ]);
    }


    #[Route('/{id}', name: 'app_concours_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        $comments = $article->getComments();
        $user = $this->getUser(); 
        if ($user) {
            $library = $user->getLibrary();
        } else {
            $library = null; 
        }
        
        return $this->render('concours/show.html.twig', [
            'article' => $article,
            'comments' => $comments,
            'library' => $library
        ]);
    }

}

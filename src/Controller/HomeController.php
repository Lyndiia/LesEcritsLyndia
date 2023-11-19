<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $user = $this->getUser(); 
        if ($user) {
            $library = $user->getLibrary();
        } else {
            $library = null; 
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'library' => $library
        ]);
    }
}

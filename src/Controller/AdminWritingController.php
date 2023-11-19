<?php

namespace App\Controller;

use App\Entity\Writing;
use App\Form\WritingType;
use App\Repository\WritingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/writing')]
#[IsGranted('ROLE_ADMIN')]
class AdminWritingController extends AbstractController
{
    #[Route('/', name: 'app_admin_writing_index', methods: ['GET'])]
    public function index(WritingRepository $writingRepository): Response
    {
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        return $this->render('admin_writing/index.html.twig', [
            'writings' => $writingRepository->findAll(),
            'library' => $library
        ]);
    }


    #[Route('/{id}', name: 'app_admin_writing_show', methods: ['GET'])]
    public function show(Writing $writing): Response
    {
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        return $this->render('admin_writing/show.html.twig', [
            'writing' => $writing,
            'library' => $library
        ]);
    }



    #[Route('/{id}', name: 'app_admin_writing_delete', methods: ['POST'])]
    public function delete(Request $request, Writing $writing, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$writing->getId(), $request->request->get('_token'))) {
            $entityManager->remove($writing);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_writing_index', [], Response::HTTP_SEE_OTHER);
    }
}

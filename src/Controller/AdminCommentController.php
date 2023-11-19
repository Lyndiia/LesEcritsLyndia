<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


#[Route('/admin/comment')]
#[IsGranted("ROLE_ADMIN")]
class AdminCommentController extends AbstractController
{
    #[Route('/', name: 'app_admin_comment_index', methods: ['GET'])]
    public function index(CommentRepository $commentRepository): Response
    {
        $user = $this->getUser(); 
        $library = $user->getLibrary();
        return $this->render('admin_comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
            'library' => $library
        ]);
    }


    #[Route('/{id}', name: 'app_admin_comment_show', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function show(Comment $comment): Response
    {
        $user = $this->getUser(); 
        $library = $user->getLibrary();

        return $this->render('admin_comment/show.html.twig', [
            'comment' => $comment,
            'library' => $library
        ]);
    }

    #[Route('/{id}', name: 'app_admin_comment_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_comment_index', [], Response::HTTP_SEE_OTHER);
    }
}

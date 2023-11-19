<?php

namespace App\Controller;

use App\Entity\Library;
use App\Entity\Story;
use App\Form\LibraryType;
use App\Repository\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Scalar\MagicConst\Line;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/library')]
#[IsGranted('ROLE_USER')]
class LibraryController extends AbstractController
{


    #[Route('/{id}', name: 'app_library_show', methods: ['GET'])]
    public function show(Library $library, Story $story ): Response
    {
               $user = $this->getUser();

        if ($user) {
            $libraryStories = $user->getLibrary()->getLibRead();

            return $this->render('library/show.html.twig', [
                'libraryStories' => $libraryStories,
                'library' => $library,
            ]);
        }

        // Gérez le cas où l'utilisateur n'est pas connecté
        return $this->redirectToRoute('app_login');
    }
    

    #[Route('/library/remove/{libraryId}/{storyId}', name: 'app_remove_from_library', methods: ['GET'])]
    public function removeFromLibrary($libraryId ,$storyId, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if ($user) {
            $story = $entityManager->getRepository(Story::class)->find($storyId);
            $library = $entityManager->getRepository(Library::class)->find($libraryId);
            

            if ($story && $library) {
                $user->getLibrary()->removeLibRead($story);

                $entityManager->flush();

                $this->addFlash('success', 'L\'histoire a été retirée de votre bibliothèque.');

                return $this->redirectToRoute('app_library_show',['id' => $libraryId, 'storyId' => $storyId, ]);
            }
        }

        return $this->redirectToRoute('app_library_show', ['id' => $libraryId ]);
    }
}


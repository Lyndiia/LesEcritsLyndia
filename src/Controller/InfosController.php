<?php

namespace App\Controller;

use App\Entity\Info;
use App\Form\InfosType;
use App\Repository\InfoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/infos')]
#[IsGranted('ROLE_USER')]
class InfosController extends AbstractController
{
    #[Route('/', name: 'app_infos_index', methods: ['GET'])]
    public function index(InfoRepository $infoRepository): Response
    {
        return $this->render('infos/index.html.twig', [
            'infos' => $infoRepository->findAll(),
        ]);
    }

    #[Route('infos/new', name: 'app_infos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $info = new Info();
        $form = $this->createForm(InfosType::class, $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($info);
            $entityManager->flush();

            return $this->redirectToRoute('app_infos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('infos/new.html.twig', [
            'info' => $info,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_infos_show', methods: ['GET'])]
    public function show(Info $info): Response
    {
        $user = $this->getUser(); 
        $library = $user->getLibrary();

        return $this->render('infos/show.html.twig', [
            'info' => $info,
            'library' => $library
        ]);
    }

    #[Route('/{id}/edit', name: 'app_infos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Info $info, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InfosType::class, $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('info_pic')->getData();

            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );

                $info->setInfoPic($fileName);
            }    
            $entityManager->flush();

            return $this->redirectToRoute('app_user_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('infos/edit.html.twig', [
            'info' => $info,
            'form' => $form,
        ]);
    }

}

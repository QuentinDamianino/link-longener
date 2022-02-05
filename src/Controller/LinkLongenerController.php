<?php

namespace App\Controller;

use App\Entity\Link;
use App\Form\LinkFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LinkLongenerController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'homepage')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $link = new Link();
        $form = $this->createForm(LinkFormType::class, $link);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $link->setNewLink($this->generateNewLink($link->getOldLink()));

            $this->entityManager->persist(($link));
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('link_longener/index.html.twig', [
            'link_form' => $form->createView(),
        ]);
    }

    private function generateNewLink(string $oldLink): string
    {
        return 'placeholder';
    }
}

<?php

namespace App\Controller;

use App\Entity\Link;
use App\Form\LinkFormType;
use App\Repository\LinkRepository;
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
            $link->setNewLink($this->generateNewLink($link->getOldLink(), $request));

            $this->entityManager->persist($link);
            $this->entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('link_longener/index.html.twig', [
            'link_form' => $form->createView(),
        ]);
    }

    #[Route('/longer/{newUrl}', name: 'redirectToOldUrl')]
    public function redirectToOldUrl(Request $request, LinkRepository $linkRepository): Response
    {
        $result = $linkRepository->findOneBy([
            'newLink' => $request->getUri(),
        ]);

        return $this->redirect($result->getOldLink());
    }

    private function generateNewLink(string $oldLink, Request $request): string
    {
        $newUrl = uniqid($request->getUri() . 'longer/');

        for ($i = 0; $i < 100; $i++) {
            $newUrl .= uniqid();
        }

        return $newUrl;
    }
}

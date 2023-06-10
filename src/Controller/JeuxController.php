<?php

namespace App\Controller;

use App\Entity\Commant;
use App\Form\CommantFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuxController extends AbstractController
{
    #[Route('/Games', name: 'app_jeux')]
    public function index(): Response
    {
        return $this->render('jeux/index.html.twig', [
            'controller_name' => 'JeuxController',
        ]);
    }

    #[Route('/Games/commant', name: 'app_commant')]
    public function commant(Request $request, EntityManagerInterface $entityManager): Response
    {
        $comment = new Commant();
        $form = $this->createForm(CommantFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('app_jeux');
        }

        return $this->render('jeux/comment.html.twig', [
            'comment' => $form->createView(),
        ]);
    }
}

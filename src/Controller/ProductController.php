<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    
    #[Route('/About', name: 'app_about')]
    public function index1(): Response
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}

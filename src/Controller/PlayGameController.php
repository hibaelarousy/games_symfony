<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayGameController extends AbstractController
{
    #[Route('/play/game', name: 'app_play_game')]
    public function index(): Response
    {
        return $this->render('play_game/p_f_c.html.twig', [
            'controller_name' => 'PlayGameController',
        ]);
        
    }
    #[Route('/play/Tic_Tac', name: 'app_tic_tac')]
    public function index1(): Response
    {
        return $this->render('play_game/tic_tac.html.twig', [
            'controller_name' => 'PlayGameController',
        ]);
        
    }
    #[Route('/play/memory', name: 'app_memory')]
    public function index2(): Response
    {
        return $this->render('play_game/memory.html.twig', [
            'controller_name' => 'PlayGameController',
        ]);
        
    }
    #[Route('/play/brid', name: 'app_bird')]
    public function index3(): Response
    {
        return $this->render('play_game/bird.html.twig', [
            'controller_name' => 'PlayGameController',
        ]);
       
    }
}

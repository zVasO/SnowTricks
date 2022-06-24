<?php

namespace App\Controller;

use App\Service\TrickService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function showHome(TrickService $trickService): Response
    {
        $tricksModels = $trickService->getAllTricks();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'tricks' => $tricksModels
        ]);
    }
}

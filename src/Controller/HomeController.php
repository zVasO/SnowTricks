<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use App\Service\HomeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function showHome(TrickRepository $trickRepository): Response
    {
        $tricksModels = HomeService::getAllTricks($trickRepository);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'tricks' => $tricksModels
        ]);
    }
}

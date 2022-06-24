<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use App\Service\TrickService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    #[Route('/trick/{id}', name: 'trick_detail')]
    public function showTrick(int $id, TrickRepository $trickRepository): Response
    {
        TrickService::getTrickById($id, $trickRepository);
        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController',
        ]);
    }
}

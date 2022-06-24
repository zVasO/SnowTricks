<?php

namespace App\Controller;

use App\Service\TrickService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    public function __construct(private TrickService $trickService)
    {
    }


    /**
     * @throws Exception
     */
    #[Route('/trick/{id}', name: 'trick_detail')]
    public function showTrick(int $id): Response
    {
        $trick = $this->trickService->getTrickById($id);
        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController',
            'trick' => $trick
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/trick/edit/{id}', name: 'trick_edit')]
    public function editTrick(int $id): Response
    {
        $trick = $this->trickService->getTrickById($id);
        return $this->render('trick/edit.html.twig', [
            'controller_name' => 'TrickController',
            'trick' => $trick
        ]);
    }
}

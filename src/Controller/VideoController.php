<?php

namespace App\Controller;

use App\Service\MediaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    #[Route('/video/delete/{id}', name: 'delete_video')]
    public function deleteVideo(int $id, MediaService $mediaService, Request $request): Response
    {
        $message = $mediaService->deleteMedia("video", $id);
        if ($message) $this->addFlash($message['message-type'], $message['message-content']);

        //we redirect to the previous route
        $route = $request->headers->get('referer');
        return $this->redirect($route);

    }
}

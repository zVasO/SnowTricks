<?php

namespace App\Controller;

use App\Service\MediaService;
use App\Service\TrickService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Webmozart\Assert\Assert;

class PictureController extends AbstractController
{
    #[Route('/picture/delete/{id}', name: 'delete_picture')]
    public function deletePicture(int $id, MediaService $mediaService, Request $request): Response
    {
        Assert::integer($id);
        $message = $mediaService->deleteMedia("picture", $id);
        if ($message) $this->addFlash($message['message-type'], $message['message-content']);

        //we redirect to the previous route
        $route = $request->headers->get('referer');
        return $this->redirect($route);
    }
}

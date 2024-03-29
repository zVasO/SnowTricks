<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CommentType;
use App\Form\TrickEditFormType;
use App\Form\TrickFormType;
use App\Model\MessageEntityModel;
use App\Model\TrickEntityModel;
use App\Service\CategoryService;
use App\Service\FormService;
use App\Service\MediaService;
use App\Service\MessageService;
use App\Service\TrickService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Webmozart\Assert\Assert;

class TrickController extends AbstractController
{
    public function __construct(private TrickService $trickService, private CategoryService $categoryService, private MediaService $mediaService, private MessageService $messageService)
    {
    }

    /**
     * @param Request $request
     * @param FormService $formService
     * @return Response
     */
    #[Route('/trick/create/', name: 'trick_create')]
    public function createPageTrick(Request $request, FormService $formService): Response
    {
        $trick = new TrickEntityModel();
        $form = $this->createForm(TrickFormType::class, $trick);
        /** @var $user User */
        $user = $this->getUser();
        $message = $formService->createTrick($form, $request, $user);

         if ($message !== null) {
             $this->addFlash($message["message-type"], $message["message-content"]);
             return $this->redirectToRoute('app_home');
         }

        return $this->renderForm('trick/create.html.twig', [
            'form' => $form
        ]);
    }


    /**
     * @throws Exception
     */
    #[Route('/trick/{slug}/', name: 'trick_detail')]
    public function showTrick(string $slug, Request $request, FormService $formService): Response
    {
        $comment = new MessageEntityModel();
        $form = $this->createForm(CommentType::class, $comment);
        /** @var $user User */
        $user = $this->getUser();

        $formService->addMessage($form, $slug, $request, $user);

        $trick = $this->trickService->getTrickBySlug($slug);
        return $this->renderForm('trick/index.html.twig', [
            'controller_name' => 'TrickController',
            'trick' => $trick,
            'form' => $form
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/trick/edit/{slug}', name: 'trick_edit')]
    public function editTrick(string $slug, Request $request, FormService $formService): Response
    {
        $trick = $this->trickService->getTrickBySlug($slug);
        $categories = $this->categoryService->getAllTricks();

        $trickEntityModel = $this->trickService->getTrickEntityBySlug($slug);
        $form = $this->createForm(TrickEditFormType::class, $trickEntityModel);
        $formService->updateTrick($request, $form);

        return $this->renderForm('trick/edit.html.twig', [
            'controller_name' => 'TrickController',
            'trick' => $trick,
            'categories' => $categories,
            'form' => $form
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/trick/delete/{id}', name: 'trick_delete', methods: ['GET'])]
    public function deleteTrick(int $id): Response
    {
        Assert::integer($id);

        $message = $this->trickService->deleteTrick($id);
        if ($message) $this->addFlash($message["message-type"], $message["message-content"]);
        return $this->redirectToRoute('app_home');
    }
}

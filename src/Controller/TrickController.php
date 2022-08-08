<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CommentType;
use App\Form\TrickEditFormType;
use App\Form\TrickFormType;
use App\Model\MessageEntityModel;
use App\Model\TrickEntityModel;
use App\Service\CategoryService;
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
     * @return Response
     */
    #[Route('/trick/create/', name: 'trick_create')]
    public function createPageTrick(Request $request): Response
    {
        $trick = new TrickEntityModel();

        $form = $this->createForm(TrickFormType::class, $trick);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /** @var $user User */
            $user = $this->getUser();
            if (empty($user)) throw new AuthenticationException("Veuillez vous connecter pour ajouter un trick !");

            $trick = $form->getData();
            $response = $this->trickService->createTrickEntityFromEntityModel($trick, $user);
            $message = $response["message"];
            $this->addFlash($message["message-type"], $message["message-content"]);

            //we redirect to the trick page
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
    public function showTrick(string $slug, Request $request): Response
    {
        $comment = new MessageEntityModel();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var $user User */
            $user = $this->getUser();
            if (empty($user)) throw new AuthenticationException("Veuillez vous connecter pour ajouter un trick !");
            $trick = $this->trickService->getTrickEntityBySlug($slug);
            $comment = $form->getData();
            $this->messageService->addMessageFromMessageEntityModel($comment, $user, $trick);

        }

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
    public function editTrick(string $slug, Request $request): Response
    {
        $trick = $this->trickService->getTrickBySlug($slug);
        $categories = $this->categoryService->getAllTricks();

        $trickEntityModel = $this->trickService->getTrickEntityBySlug($slug);
        $form = $this->createForm(TrickEditFormType::class, $trickEntityModel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $trickEntityModel = $form->getData();
            $this->trickService->editTrick($trickEntityModel);
        }
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

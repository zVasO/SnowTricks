<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\TrickException;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class FormService
{

    public function __construct(private readonly TrickService $trickService, private readonly MessageService $messageService, private readonly UserRepository $userRepository)
    {
    }

    /**
     * @param Request $request
     * @param FormInterface $form
     * @return void
     */
    public function updateTrick(Request $request, FormInterface $form): void
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $trickEntityModel = $form->getData();
            $this->trickService->editTrick($trickEntityModel);
        }
    }

    /**
     * @param FormInterface $form
     * @param string $slug
     * @param Request $request
     * @param User $user
     * @return void
     * @throws TrickException
     */
    public function addMessage(FormInterface $form, string $slug, Request $request, User $user): void
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (empty($user)) throw new AuthenticationException("Veuillez vous connecter pour ajouter un trick !");
            $trick = $this->trickService->getTrickEntityBySlug($slug);
            $comment = $form->getData();
            $this->messageService->addMessageFromMessageEntityModel($comment, $user, $trick);
        }
    }

    /**
     * @param FormInterface $form
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    public function createTrick(FormInterface $form, Request $request, User $user): mixed
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (empty($user)) throw new AuthenticationException("Veuillez vous connecter pour ajouter un trick !");
            $trick = $form->getData();
            $response = $this->trickService->createTrickEntityFromEntityModel($trick, $user);
            return $response["message"];
        }
        return null;
    }

    /**
     * @param FormInterface $form
     * @param User $user
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param Request $request
     * @return bool
     */
    public function createUser(FormInterface $form, User $user, UserPasswordHasherInterface $userPasswordHasher, Request $request): bool
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $this->userRepository->add($user, true);
            return true;
        }
        return false;
    }
}

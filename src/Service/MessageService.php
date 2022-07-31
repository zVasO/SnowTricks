<?php

namespace App\Service;

use App\Entity\Message;
use App\Entity\Trick;
use App\Entity\User;
use App\Model\MessageEntityModel;
use App\Repository\MessageRepository;
use App\Service\Factory\MessageFactory;
use DateTimeImmutable;

class MessageService
{


    public function __construct(private MessageRepository $messageRepository)
    {
    }

    public function addMessageFromMessageEntityModel(MessageEntityModel $messageEntityModel, User $user, Trick $trick)
    {
        $messageEntity = new Message();
        $messageEntity->setTrick($trick)
            ->setUser($user)
            ->setContent($messageEntityModel->content)
            ->setCreatedAt(new DateTimeImmutable());
        $this->messageRepository->add($messageEntity, true);
        return MessageFactory::getFlashArray(MessageFactory::MESSAGE_TYPE_SUCCESS, "Le commentaire a été ajouté !");
    }
}

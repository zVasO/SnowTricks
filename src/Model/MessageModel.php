<?php

namespace App\Model;

use App\Entity\Message;
use DateTimeImmutable;

class MessageModel
{

    public int $id;
    public string $content;
    public DateTimeImmutable $createdAt;
    public TrickModel $trick;
    public UserModel $user;

    public function __construct(Message $messageEntity)
    {
        $this->id = $messageEntity->getId();
        $this->content = $messageEntity->getContent();
        $this->createdAt = $messageEntity->getCreatedAt();
        $this->trick = new TrickModel($messageEntity->getTrick());
        $this->user = new UserModel($messageEntity->getUser());
    }


}

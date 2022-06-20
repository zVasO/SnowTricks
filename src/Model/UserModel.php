<?php

namespace App\Model;

use App\Entity\Message;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;

class UserModel
{
    public int $id;
    public string $email;
    public string $username;
    public array $tricks;
    public array $messages;
    private array $roles = [];
    private string $password;

    /**
     * @param User $userEntity
     */
    public function __construct(User $userEntity)
    {
        $this->id       = $userEntity->getId();
        $this->email    = $userEntity->getEmail();
        $this->username = $userEntity->getUsername();
        $this->roles    = $userEntity->getRoles();
        $this->password = $userEntity->getPassword();
        $this->initTricksArray($userEntity->getTricks());
        $this->initMessagesArray($userEntity->getMessages());
    }

    /**
     * @param Collection $messagesCollection
     */
    private function initMessagesArray(Collection $messagesCollection): void
    {
        $this->messages = [];
        foreach ($messagesCollection as $messageEntity) {
            $this->messages[] = new MessageModel($messageEntity);
        }
    }

    /**
     * @param Collection $tricksCollection
     */
    private function initTricksArray(Collection $tricksCollection): void
    {
        $this->tricks = [];
        foreach ($tricksCollection as $trickEntity) {
            $this->tricks[] = new TrickModel($trickEntity);
        }
    }
}

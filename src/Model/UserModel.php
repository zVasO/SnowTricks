<?php

namespace App\Model;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;

class UserModel
{
    public int $id;
    public string $email;
    public string $username;
    private array $roles = [];
    private string $password;
    public Collection $tricks;
    public Collection $messages;

    /**
     * @param User $userEntity
     */
    public function __construct(User $userEntity)
    {
        $this->id = $userEntity->getId();
        $this->email = $userEntity->getEmail();
        $this->username = $userEntity->getUsername();
        $this->roles = $userEntity->getRoles();
        $this->password = $userEntity->getPassword();
        $this->tricks = $userEntity->getTricks();
        $this->messages = $userEntity->getMessages();
    }
}

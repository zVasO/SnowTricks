<?php

namespace App\Model;

use App\Entity\User;
use App\Service\ModelService;
use Doctrine\Common\Collections\Collection;

class UserModel
{
    public readonly int $id;
    public string $email;
    public string $username;
    public Collection $tricks;
    public Collection $messages;
    private array $roles;
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
        $this->tricks   = $userEntity->getTricks();
        $this->messages = $userEntity->getMessages() ;
    }
}

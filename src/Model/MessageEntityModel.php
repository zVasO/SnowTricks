<?php

namespace App\Model;

use App\Entity\Message;
use DateTimeImmutable;

class MessageEntityModel
{
    public readonly int $id;
    public string $content;
    public DateTimeImmutable $createdAt;
    public TrickModel $trick;
    public UserModel $user;

    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return TrickModel
     */
    public function getTrick(): TrickModel
    {
        return $this->trick;
    }

    /**
     * @param TrickModel $trick
     */
    public function setTrick(TrickModel $trick): void
    {
        $this->trick = $trick;
    }

    /**
     * @return UserModel
     */
    public function getUser(): UserModel
    {
        return $this->user;
    }

    /**
     * @param UserModel $user
     */
    public function setUser(UserModel $user): void
    {
        $this->user = $user;
    }

}

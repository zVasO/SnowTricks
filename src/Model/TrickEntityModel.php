<?php

namespace App\Model;

use App\Entity\Category;
use App\Entity\Trick;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

class TrickEntityModel
{

    public int $id;
    public string $name;
    public array $message;
    public string $description;
    public Collection|array $picture;
    public Collection|array $video;
    public Category $category;
    public DateTimeImmutable $createdAt;
    public DateTimeImmutable $updatedAt;
    public UserModel $user;

    /**
     */
    public function __construct()
    {

    }
}

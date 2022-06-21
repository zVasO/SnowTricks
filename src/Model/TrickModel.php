<?php

namespace App\Model;

use App\Entity\Category;
use App\Entity\Trick;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;

class TrickModel
{

    public int $id;
    public string $name;
    public Collection $message;
    public string $description;
    public Collection $picture;
    public Collection $video;
    public Category $category;
    public DateTimeImmutable $createdAt;
    public DateTimeImmutable $updatedAt;
    public UserModel $user;

    /**
     * @param Trick $trickEntity
     */
    #[Pure] public function __construct(Trick $trickEntity)
    {
        $this->id = $trickEntity->getId();
        $this->name = $trickEntity->getName();
        $this->message = $trickEntity->getMessage();
        $this->description = $trickEntity->getDescription();
        $this->video = $trickEntity->getVideo();
        $this->picture = $trickEntity->getPicture();
        $this->category = $trickEntity->getCategory();
        $this->createdAt = $trickEntity->getCreatedAt();
        $this->updatedAt = $trickEntity->getUpdatedAt();
        $this->user = new UserModel($trickEntity->getUser());
    }
}

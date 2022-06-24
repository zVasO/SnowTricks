<?php

namespace App\Model;

use App\Entity\Category;
use App\Entity\Trick;
use App\Service\ModelService;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

class TrickModel
{

    public readonly int $id;
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
    public function __construct(Trick $trickEntity)
    {
        $this->id          = $trickEntity->getId();
        $this->name        = $trickEntity->getName();
        $this->message     = $trickEntity->getMessage();
        $this->description = $trickEntity->getDescription();
        $this->video       = $trickEntity->getVideo();
        $this->picture     = $trickEntity->getPicture();
        $this->category    = $trickEntity->getCategory();
        $this->createdAt   = $trickEntity->getCreatedAt();
        $this->updatedAt   = $trickEntity->getUpdatedAt();
        $this->user        = new UserModel($trickEntity->getUser());
    }
}

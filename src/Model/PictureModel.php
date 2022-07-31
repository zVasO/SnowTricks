<?php

namespace App\Model;

use App\Entity\Picture;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;

class PictureModel
{
    public readonly int $id;
    public string $link;
    public TrickModel $trick;

    /**
     * @param Picture $pictureEntity
     */
    public function __construct(Picture $pictureEntity)
    {
        $this->id = $pictureEntity->getId();
        $this->link = $pictureEntity->getLink();
        $this->trick = new TrickModel($pictureEntity->getTrick());
    }
}

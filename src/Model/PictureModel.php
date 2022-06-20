<?php

namespace App\Model;

use App\Entity\Picture;
use JetBrains\PhpStorm\Pure;

class PictureModel
{
    public int $id;
    public string $link;
    public TrickModel $trick;

    /**
     * @param Picture $pictureEntity
     */
    #[Pure] public function __construct(Picture $pictureEntity)
    {
        $this->id = $pictureEntity->getId();
        $this->link = $pictureEntity->getLink();
        $this->trick = new TrickModel($pictureEntity->getTrick());
    }
}

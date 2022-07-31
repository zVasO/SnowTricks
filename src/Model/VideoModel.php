<?php

namespace App\Model;

use App\Entity\Video;

class VideoModel
{
    public readonly int $id;
    public string $link;
    public TrickModel $trick;

    /**
     * @param Video $videoEntity
     */
    public function __construct(Video $videoEntity)
    {
        $this->id    = $videoEntity->getId();
        $this->link  = $videoEntity->getLink();
        $this->trick = new TrickModel($videoEntity->getTrick());
    }
}

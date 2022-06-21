<?php

namespace App\Model;

use App\Entity\Video;
use JetBrains\PhpStorm\Pure;

class VideoModel
{
    public int $id;
    public string $link;
    public TrickModel $trick;

    /**
     * @param Video $videoEntity
     */
    #[Pure] public function __construct(Video $videoEntity)
    {
        $this->id = $videoEntity->getId();
        $this->link = $videoEntity->getLink();
        $this->trick = new TrickModel($videoEntity->getTrick());
    }


}

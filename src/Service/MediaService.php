<?php

namespace App\Service;

use App\Repository\PictureRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use phpDocumentor\Reflection\Types\This;

class MediaService
{

    public function __construct(private PictureRepository $pictureRepository, private VideoRepository $videoRepository)
    {
    }

    public function updateMediaEntity(?string $media, ?string $url): bool
    {
        if (empty($media) || empty($url)) return true;
        $mediaArray = explode(":", $media);
        return match ($mediaArray[0]) {
            "picture" => $this->pictureRepository->updatePictureById($mediaArray[1], $url),
            "video" => $this->videoRepository->updateVideoById($mediaArray[1], $url),
        };
    }
}

<?php

namespace App\Service;

use App\Repository\PictureRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use phpDocumentor\Reflection\Types\This;

class MediaService
{

    public function __construct(private PictureRepository $pictureRepository, private VideoRepository $videoRepository, private EntityManager $entityManager)
    {
    }

    public function updateMediaEntity(string $media, string $url): void
    {
        $mediaArray = explode(":", $media, 1);
        $entity = match ($mediaArray[0]) {
            "picture" => $this->pictureRepository->find($mediaArray[1])->setLink($url),
            "video" => $this->videoRepository->find($mediaArray[1])->setLink($url),
        };
        $this->entityManager->persist($entity);
    }
}

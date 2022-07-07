<?php

namespace App\Service;

use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use App\Repository\PictureRepository;
use App\Repository\VideoRepository;

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

    /**
     * @param Trick $trick
     * @param array $additionalMedia
     * @param array $trickForm
     * @return void
     */
    public function addedNewMedia(Trick $trick, array $additionalMedia, array $trickForm)
    {
        //we create the first picture who's mandatory
        $pictureEntity = new Picture();
        $pictureEntity->setLink($trickForm["picture"])
            ->setTrick($trick);
        $this->pictureRepository->add($pictureEntity, true);

        //we create the first video, who's also mandatory
        $videoEntity = new Video();
        $videoEntity->setLink($trickForm["video"])
            ->setTrick($trick);
        $this->videoRepository->add($videoEntity, true);

        foreach ($additionalMedia["picture"] as $picture) {
            (new Picture())->setLink($picture)
                ->setTrick($trick);
        }
        foreach ($additionalMedia["video"] as $video) {
            (new Video())->setLink($video)
                ->setTrick($trick);
        }

    }
}

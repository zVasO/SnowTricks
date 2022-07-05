<?php

namespace App\Service;

use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use App\Repository\PictureRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Request;

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

    public function addedNewMedia(Trick $trick, Request $request)
    {
        $trickInformations = $request->request->all('create_trick_form');
        //we create the first picture who's mandatory
        $pictureEntity =  new Picture();
        $pictureEntity->setLink($trickInformations["picture"])
            ->setTrick($trick);
        $this->pictureRepository->add($pictureEntity, true);

        //we create the first video, who's also mandatory
        $videoEntity = new Video();
        $videoEntity->setLink($trickInformations["video"])
            ->setTrick($trick);
        $this->videoRepository->add($videoEntity, true);

        //we make a loop for all optionnal picture
        if (!empty($request->request->get('picture-count'))) {
            for ($i = 0 ; $i < $request->request->get('picture-count') ; $i++) {
                $pictureEntity =  new Picture();
                $pictureEntity->setLink($request->request->get('picture'.$i))
                    ->setTrick($trick);
                $this->pictureRepository->add($pictureEntity, true);
            }
        }

        //we make a loop for all optionnal picture
        if (!empty($request->request->get('video-count'))) {
            for ($i = 0 ; $i < $request->request->get('video-count') ; $i++) {
                $videoEntity = new Video();
                $videoEntity->setLink($request->request->get('video'.$i))
                    ->setTrick($trick);
                $this->videoRepository->add($videoEntity, true);
            }
        }
    }
}

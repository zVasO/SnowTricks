<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use App\Exception\TrickException;
use App\Model\TrickEntityModel;
use App\Model\TrickModel;
use App\Repository\TrickRepository;
use App\Service\Factory\TrickFactory;
use Exception;
use Monolog\DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class TrickService implements ITrickService
{

    public function __construct(private TrickRepository $trickRepository, private TrickFactory $trickFactory, private MediaService $mediaService)
    {
    }

    /**
     * @inheritDoc
     */
    public function getTrickById(int $id): TrickModel
    {
        $trickEntity = $this->trickRepository->find($id);
        if (empty($trickEntity)) {
            throw new TrickException("Le trick ayant pour id $id n'existe pas !!", Response::HTTP_NO_CONTENT);
        }
        return new TrickModel($trickEntity);
    }

    /**
     * @inheritDoc
     */
    public function getAllTricks(): array
    {
        $allTricksEntities = $this->trickRepository->findAll();
        return $this->trickFactory->convertTricksEntitiesToTricksModels($allTricksEntities);
    }

    /**
     * @inheritDoc
     */
    public function updateTrickById(int $id, string $description, Category $category)
    {
        $this->trickRepository->updateTrickById($id, $description, $category);
    }

    /**
     * @inheritDoc
     */
    public function createTrick(array $trickForm, Category $category, User $user, array $additionalMedia): int
    {
        $trickEntity = new Trick();
        $trickEntity->setName($trickForm["name"])
            ->setCategory($category)
            ->setDescription($trickForm["description"])
            ->setUser($user);

        $this->trickRepository->add($trickEntity, true);
        $this->mediaService->addedNewMedia($trickEntity, $additionalMedia, $trickForm);
        return $trickEntity->getId();
    }

    /**
     * @inheritDoc
     */
    public function deleteTrick(int $id): array
    {
        $trickEntity = $this->trickRepository->find($id);
        if ($trickEntity) $this->trickRepository->remove($trickEntity, true);
        return FlashService::getFlashArray(FlashService::MESSAGE_TYPE_SUCCESS, "Le trick a correctement été supprimé !");
    }

    /**
     * @inheritDoc
     */
    public function addTrick(Trick $trick, User $user): array
    {
        $trick->setUser($user);
        $this->trickRepository->add($trick, true);
        return FlashService::getFlashArray(FlashService::MESSAGE_TYPE_SUCCESS, "Le trick a correctement été ajouté !");
    }

    /**
     * @inheritDoc
     */
    public function createTrickEntityFromEntityModel(TrickEntityModel $trickEntityModel, User $user): array
    {

        $trickEntity = new Trick();
        $trickEntity->setUser($user)
            ->setName($trickEntityModel->name)
            ->setCategory($trickEntityModel->category)
            ->setDescription($trickEntityModel->description);

        foreach ($trickEntityModel->picture as $key => $picture) {
            $pictureEntity = (new Picture())->setLink($picture)->setTrick($trickEntity);
            $trickEntity->addPicture($pictureEntity);
            $this->mediaService->addPictureEntity($pictureEntity);
        }
        foreach ($trickEntityModel->video as $key => $video) {
            $videoEntity = (new Video())->setLink($video)->setTrick($trickEntity);
            $trickEntity->addVideo($videoEntity);
            $this->mediaService->addVideoEntity($videoEntity);
        }
        $this->trickRepository->add($trickEntity, true);
        return [
                "trick" => $trickEntity,
                "message" =>  FlashService::getFlashArray(FlashService::MESSAGE_TYPE_SUCCESS, "La figure a été ajouté correctement !")
            ];
    }

    /**
     * @inheritDoc
     */
    public function getTrickEntityById(int $id): Trick
    {
        $trickEntity = $this->trickRepository->find($id);
        if (empty($trickEntity)) {
            throw new TrickException("Le trick ayant pour id $id n'existe pas !!", Response::HTTP_NO_CONTENT);
        }
        return $trickEntity;
    }


}

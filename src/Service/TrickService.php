<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Trick;
use App\Entity\User;
use App\Exception\TrickException;
use App\Model\TrickModel;
use App\Repository\TrickRepository;
use App\Service\Factory\TrickFactory;
use Exception;
use Monolog\DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
}

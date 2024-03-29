<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Trick;
use App\Entity\User;
use App\Exception\TrickException;
use App\Model\TrickEntityModel;
use App\Model\TrickModel;
use Exception;

interface TrickServiceInterface
{
    /**
     * @throws Exception
     */
    public function getTrickById(int $id): TrickModel;


    /**
     * Get all tricks entities and return an array of tricks (Model)
     * @return array
     */
    public function getAllTricks(): array;


    /**
     * @param array $trickForm
     * @param Category $category
     * @param User $user
     * @param array $additionalMedia
     * @return int Trick identifier created
     */
    public function createTrick(array $trickForm, Category $category, User $user, array $additionalMedia): int;

    /**
     * @param int $id
     * @return array
     */
    public function deleteTrick(int $id): array;

    /**
     * @param Trick $trick
     * @param User $user
     * @return array
     */
    public function addTrick(Trick $trick, User $user): array;

    /**
     * @param TrickEntityModel $trickEntityModel
     * @param User $user
     * @return array
     */
    public function createTrickEntityFromEntityModel(TrickEntityModel $trickEntityModel, User $user): array;

    /**
     * @param int $id
     * @return Trick
     * @throws TrickException
     */
    public function getTrickEntityById(int $id): Trick;

    /**
     * @param int $id
     * @return TrickEntityModel
     */
    public function getTrickEntityModelById(int $id): TrickEntityModel;

    /**
     * @param Trick $trick
     * @return void
     */
    public function editTrick(Trick $trick): void;

    /**
     * @param string $slug
     * @return Trick
     * @throws TrickException
     */
    public function getTrickEntityBySlug(string $slug): Trick;

    /**
     * @param string $slug
     * @return TrickModel
     * @throws TrickException
     */
    public function getTrickBySlug(string $slug): TrickModel;
}

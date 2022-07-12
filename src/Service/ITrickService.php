<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Trick;
use App\Entity\User;
use App\Model\TrickEntityModel;
use App\Model\TrickModel;
use Exception;
use Symfony\Component\HttpFoundation\Request;

interface ITrickService
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
     * @param int $id
     * @param string $description
     * @param Category $category
     * @return void
     */
    public function updateTrickById(int $id, string $description, Category $category);

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
}

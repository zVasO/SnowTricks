<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Trick;
use App\Entity\User;
use App\Model\TrickModel;
use Exception;

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
     * @param array $trickInformations
     * @param Category $category
     * @param User $user
     * @return Trick
     */
    public function createTrick(array $trickInformations, Category $category, User $user): Trick;
}

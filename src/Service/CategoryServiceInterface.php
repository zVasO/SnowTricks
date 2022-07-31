<?php

namespace App\Service;

use App\Entity\Category;
use App\Exception\TrickException;
use App\Model\CategoryModel;

interface CategoryServiceInterface
{

    /**
     * @param int $id
     * @return CategoryModel
     * @throws TrickException
     */
    public function getCategoryById(int $id): CategoryModel;


    /**
     * @param int $id
     * @return Category
     * @throws TrickException
     */
    public function getCategoryEntityById(int $id): Category;

    /**
     * @return array
     */
    public function getAllTricks(): array;

    /**
     * @return array
     */
    public function getArrayOfCategoryForFormType(): array;
}

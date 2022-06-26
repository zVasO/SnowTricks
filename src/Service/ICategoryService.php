<?php

namespace App\Service;

use App\Entity\Category;
use App\Exception\TrickException;
use App\Model\CategoryModel;

interface ICategoryService
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
}

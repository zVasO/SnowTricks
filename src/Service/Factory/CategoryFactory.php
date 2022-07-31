<?php

namespace App\Service\Factory;

use App\Model\CategoryModel;

class CategoryFactory implements CategoryFactoryInterface
{

    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function convertCategoriesEntitiesToCategoriesModels(array $categoriesEntities): array
    {
        $categoriesModels = [];
        foreach ($categoriesEntities as $categoryEntity) {
            $categoriesModels[] = new CategoryModel($categoryEntity);
        }
        return $categoriesModels;
    }
}

<?php

namespace App\Service\Factory;

interface CategoryFactoryInterface
{
    /**
     * @param array $categoriesEntities
     * @return array
     */
    public function convertCategoriesEntitiesToCategoriesModels(array $categoriesEntities): array;
}

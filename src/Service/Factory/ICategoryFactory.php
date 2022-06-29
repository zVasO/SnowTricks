<?php

namespace App\Service\Factory;

interface ICategoryFactory
{
    /**
     * @param array $categoriesEntities
     * @return array
     */
    public function convertCategoriesEntitiesToCategoriesModels(array $categoriesEntities): array;
}

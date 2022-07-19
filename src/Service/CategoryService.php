<?php

namespace App\Service;

use App\Entity\Category;
use App\Exception\TrickException;
use App\Model\CategoryModel;
use App\Repository\CategoryRepository;
use App\Service\Factory\CategoryFactory;
use Symfony\Component\HttpFoundation\Response;

class CategoryService implements CategoryServiceInterface
{

    public function __construct(private CategoryRepository $categoryRepository, private CategoryFactory $categoryFactory)
    {
    }

    /**
     * @inheritDoc
     */
    public function getCategoryById(int $id): CategoryModel
    {
        $trickEntity = $this->categoryRepository->find($id);
        if (empty($trickEntity)) {
            throw new TrickException("La category ayant pour id $id n'existe pas !!", Response::HTTP_NO_CONTENT);
        }
        return new CategoryModel($trickEntity);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryEntityById(int $id): Category
    {
        $trickEntity = $this->categoryRepository->find($id);
        if (empty($trickEntity)) {
            throw new TrickException("La category ayant pour id $id n'existe pas !!", Response::HTTP_NO_CONTENT);
        }
        return $trickEntity;
    }

    /**
     * @inheritDoc
     */
    public function getAllTricks(): array
    {
        $allCategoriesEntities = $this->categoryRepository->findAll();
        return $this->categoryFactory->convertCategoriesEntitiesToCategoriesModels($allCategoriesEntities);
    }


    /**
     * @inheritDoc
     */
    public function getArrayOfCategoryForFormType(): array
    {
        $allCategoriesEntities = $this->categoryRepository->findAll();
        $arrayOfCategories = [];
        foreach ($allCategoriesEntities as $key => $category) {
            $arrayOfCategories[$category->getName()] = $category->getId();
        }
        return $arrayOfCategories;
    }

}

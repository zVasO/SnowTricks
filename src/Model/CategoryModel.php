<?php

namespace App\Model;

use App\Entity\Category;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;

class CategoryModel
{

    public readonly int $id;
    public string $name;
    public Collection $tricks;

    /**
     * @param Category $categoryEntity
     */
    #[Pure] public function __construct(Category $categoryEntity)
    {
        $this->id     = $categoryEntity->getId();
        $this->name   = $categoryEntity->getName();
        $this->tricks = $categoryEntity->getTricks();
    }
}

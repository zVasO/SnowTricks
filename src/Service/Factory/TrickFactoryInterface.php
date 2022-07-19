<?php

namespace App\Service\Factory;

use App\Model\TrickModel;

interface TrickFactoryInterface
{

    /**
     * @param array $tricksEntities
     * @return TrickModel[]
     */
    public function convertTricksEntitiesToTricksModels(array $tricksEntities): array;
}

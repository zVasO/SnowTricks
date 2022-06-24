<?php

namespace App\Service\Factory;

use App\Model\TrickModel;

class TrickFactory implements ITrickFactory
{

    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function convertTricksEntitiesToTricksModels(array $tricksEntities): array
    {
        $tricksModels = [];
        foreach ($tricksEntities as $trickEntity) {
            $tricksModels[] = new TrickModel($trickEntity);
        }
        return $tricksModels;
    }
}

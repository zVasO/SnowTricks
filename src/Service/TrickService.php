<?php

namespace App\Service;

use App\Model\TrickModel;
use JetBrains\PhpStorm\Pure;

class TrickService
{

    public function __construct()
    {
    }

    /**
     * @param array $tricksEntities
     * @return array
     */
    public static function convertTricksEntitiesToTricksModels(array $tricksEntities): array
    {
        $tricksModels = [];
        foreach ($tricksEntities as $trickEntity) {
            $tricksModels[] = new TrickModel($trickEntity);
        }
        return $tricksModels;
    }
}

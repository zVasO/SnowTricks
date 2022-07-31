<?php

namespace App\Service\Factory;

use App\Model\TrickEntityModel;
use App\Model\TrickModel;

interface TrickFactoryInterface
{

    /**
     * @param array $tricksEntities
     * @return TrickModel[]
     */
    public function convertTricksEntitiesToTricksModels(array $tricksEntities): array;

    /**
     * @param TrickModel $trickModel
     * @return TrickEntityModel
     */
    public function convertTrickModelToTrickEntityModel(TrickModel $trickModel): TrickEntityModel;
}

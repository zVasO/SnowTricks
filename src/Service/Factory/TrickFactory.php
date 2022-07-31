<?php

namespace App\Service\Factory;

use App\Model\TrickEntityModel;
use App\Model\TrickModel;

class TrickFactory implements TrickFactoryInterface
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

    /**
     * @inheritDoc
     */
    public function convertTrickModelToTrickEntityModel(TrickModel $trickModel): TrickEntityModel
    {
        $trickEntityModel = new TrickEntityModel();
        $trickEntityModel->user = $trickModel->user;
        $trickEntityModel->createdAt = $trickModel->createdAt;
        $trickEntityModel->updatedAt = $trickModel->updatedAt;
        $trickEntityModel->category = $trickModel->category;
        $trickEntityModel->id = $trickModel->id;
        $trickEntityModel->name = $trickModel->name;
        $trickEntityModel->picture = $trickModel->picture;
        $trickEntityModel->video = $trickModel->video;


        return $trickEntityModel;
    }
}

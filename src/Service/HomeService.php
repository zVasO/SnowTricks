<?php

use App\Repository\TrickRepository;

class HomeService
{

    public function __construct()
    {
    }


    /**
     * Get all tricks entities and return an array of tricks (Model)
     * @param TrickRepository $trickRepository
     * @return array
     */
    public static function getAllTricks(TrickRepository $trickRepository): array
    {
        $allTricksEntities = $trickRepository->findAll();
        return TrickService::convertTricksEntitiesToTricksModels($allTricksEntities);
    }
}

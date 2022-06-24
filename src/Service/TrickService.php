<?php

namespace App\Service;

use App\Model\TrickModel;
use App\Repository\TrickRepository;
use Exception;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\Response;

class TrickService
{

    public function __construct()
    {
    }

    /**
     * @throws Exception
     */
    public static function getTrickById(int $id, TrickRepository $trickRepository): TrickModel
    {

        $trickEntity = $trickRepository->find($id);
        if (empty($trickEntity)) {
            throw new Exception("Le trick ayant pour id $id n'existe pas !!", Response::HTTP_NO_CONTENT);
        }
        return new TrickModel($trickEntity);
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

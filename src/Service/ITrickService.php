<?php

namespace App\Service;

use App\Model\TrickModel;
use App\Repository\TrickRepository;
use Exception;

interface ITrickService
{
    /**
     * @throws Exception
     */
    public function getTrickById(int $id): TrickModel;


    /**
     * Get all tricks entities and return an array of tricks (Model)
     * @return array
     */
    public function getAllTricks(): array;
}

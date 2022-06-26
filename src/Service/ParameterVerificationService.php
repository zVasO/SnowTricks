<?php

namespace App\Service;

use Exception;

class ParameterVerificationService
{

    public function __construct()
    {
    }

    public static function verifyTrickEditArray(array $trick)
    {
        if (isset($trick['trick-description']) && isset($trick['category']) && isset($trick['trick-btn-save']) && $trick['trick-btn-save'] === 'save') {
            return true;
        }
        throw new Exception('Invalid parameters');
    }
}

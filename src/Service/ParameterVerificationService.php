<?php

namespace App\Service;

use Exception;

class ParameterVerificationService
{

    public function __construct()
    {
    }

    public static function verifyTrickEditArray(array $trick): bool
    {
        if (!empty($trick['trick-description']) && !empty($trick['category']) && !empty($trick['trick-btn-save']) && $trick['trick-btn-save'] === 'save') {
            return true;
        }
        throw new Exception('Invalid parameters');
    }

    public static function verifyMedia(array $trick)
    {
        if (empty($trick['url-media']) && empty($trick["media-id"])) {
            return false;
        }
        return true;
    }
}

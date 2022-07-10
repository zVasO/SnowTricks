<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class FlashService
{
    public const MESSAGE_TYPE_PRIMARY = "primary";
    public const MESSAGE_TYPE_SECONDARY = "secondary";
    public const MESSAGE_TYPE_SUCCESS = "success";
    public const MESSAGE_TYPE_DANGER = "danger";
    public const MESSAGE_TYPE_WARNING = "warning";
    public const MESSAGE_TYPE_INFO = "info";
    public const MESSAGE_TYPE_LIGHT = "light";
    public const MESSAGE_TYPE_DARK = "dark";

    public static function getFlashArray(string $typeMessage, string $messageContent)
    {
        return [
            "message-type" => $typeMessage,
            "message-content" => "$messageContent"
        ];
    }

}

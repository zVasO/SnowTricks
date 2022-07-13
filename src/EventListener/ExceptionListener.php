<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Twig\Environment;

class ExceptionListener
{


    public function __construct(private Environment $environment)
    {
    }

    public function onKernelException(ExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getThrowable();
        $response = new Response();
        $response->setContent($this->environment->render('error.html.twig', [
            'error_code' => $exception->getCode(),
            'error_message' => $exception->getMessage(),
        ]));
        $event->setResponse($response);
    }
}

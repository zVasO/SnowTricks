<?php

namespace App\Service;

use App\Entity\User;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class MailerService
{


    public function __construct(private readonly EmailVerifier $emailVerifier)
    {
    }

    public function sendMail(string $route, User $user, string $mailFrom, string $nameFrom, string $emailTo, string $subject, string $htmlTemplatePath)
    {
        // generate a signed url and email it to the user
        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            (new TemplatedEmail())
                ->from(new Address('dev.dyger@gmail.com', 'SnowTrick'))
                ->to($user->getEmail())
                ->subject('Confirmez votre adresse email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );
    }
}

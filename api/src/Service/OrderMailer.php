<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class OrderMailer
{
    public function __construct(
        private MailerInterface $mailer,
        private LoggerInterface $telegramDebugLogger
    )
    {
    }

    public function sendEmail(string $receiver, string $message): void
    {
        $email = (new Email())
            ->to($receiver)
            ->subject('Service booking information')
            ->embedFromPath('uploads/photo/dummy.jpg', 'footer-signature')
            ->html("<p>$message</p>" . '<img alt="dummy" src="cid:footer-signature" width="250" height="250">');

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $exception) {
            $this->telegramDebugLogger->error($exception->getMessage(), ['emailObject' => $email]);
        }
    }
}
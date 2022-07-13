<?php

namespace App\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private LoggerInterface $telegramLogger
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::EXCEPTION => [
                ['processException', 10],
                ['logException', 0]
            ],
        ];
    }

    public function processException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $telegramMessage = $exception->getMessage();
        $response = new Response();

        if ($exception instanceof AccessDeniedException) {
            $response->setStatusCode($exception->getCode());
            $response->setContent(json_encode([
                'error' => $exception->getMessage()
            ]));

            $event->setResponse($response);
            $telegramMessage .= $exception->getTraceAsString();
        }

        $this->telegramLogger->error($telegramMessage);
    }

    public function logException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $this->telegramLogger->error($exception->getMessage());
    }
}
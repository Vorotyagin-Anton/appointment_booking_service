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
        private LoggerInterface $telegramDebugLogger
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::EXCEPTION => [
                ['processException', 10],
                ['logException', 20]
            ],
        ];
    }

    public function processException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $response = new Response();

        if ($exception instanceof AccessDeniedException) {
            $response->setStatusCode($exception->getCode());
            $response->setContent(json_encode([
                'error' => $exception->getMessage()
            ]));

            $event->setResponse($response);
        }
    }

    public function logException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $exceptionMessage = $exception->getMessage();
        $exceptionTrace = $exception->getTrace();
        $exceptionClassName = $exception::class;

        if ($exception instanceof \Error) {
            $this->telegramDebugLogger
                ->critical("$exceptionClassName: $exceptionMessage at {$exception->getFile()}:{$exception->getLine()}");
            return;
        }

        if ($exception instanceof AccessDeniedException) {
            $this->telegramDebugLogger->info($exceptionMessage, $exceptionTrace);
            return;
        }

        $this->telegramDebugLogger->critical("$exceptionClassName: $exceptionMessage", $exceptionTrace);
    }
}

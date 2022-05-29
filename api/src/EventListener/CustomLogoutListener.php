<?php

namespace App\EventListener;

use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class CustomLogoutListener
{
    /**
     * @param LogoutEvent $logoutEvent
     * @return void
     */
    #[NoReturn]
    public function onSymfonyComponentSecurityHttpEventLogoutEvent(LogoutEvent $logoutEvent): void
    {
        $logoutEvent->setResponse(new JsonResponse([
            'status' => 'success',
            'message' => 'user has been logged out',
            'data' => []
        ]));
    }
}
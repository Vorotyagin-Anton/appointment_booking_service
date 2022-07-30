<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TelegramLogController extends AbstractController
{
    #[Route(path: 'api/telegram-log', name: 'app_telegram_log_post', methods: ['POST'])]
    public function addTelegramLogMessage(
        Request $request,
        LoggerInterface $telegramDebugLogger
    ): Response
    {
        $data = json_decode($request->getContent(), true);
        $message = $data['message'] ?? 'error message';
        $context = $data['context'] ?? [];
        $telegramDebugLogger->error($message, $context);

        return $this->json($message, Response::HTTP_CREATED);
    }
}

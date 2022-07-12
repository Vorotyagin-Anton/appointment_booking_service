<?php

namespace App\Service\Notifier;

use Symfony\Component\Notifier\Bridge\Telegram\TelegramOptions;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Message\ChatMessage;

class TelegramSender
{
    public function sendMessage(string $message, string $chatId, ChatterInterface $chatter): void
    {
        $chatMessage = new ChatMessage($message);

        $telegramOptions = (new TelegramOptions())
            ->chatId($chatId)
            ->parseMode('MarkdownV2')
            ->disableWebPagePreview(true)
            ->disableNotification(true);

        $chatMessage->options($telegramOptions);

        $chatter->send($chatMessage);
    }
}
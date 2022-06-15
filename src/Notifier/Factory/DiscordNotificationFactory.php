<?php

namespace App\Notifier\Factory;

use App\Notifier\Notifications\DiscordNotification;
use Symfony\Component\Notifier\Notification\Notification;

class DiscordNotificationFactory implements IterableNotificationFactoryInterface
{

    public function getNotification(string $message): Notification
    {
        return new DiscordNotification($message);
    }

    public static function getDefaultIndexName(): string
    {
        return 'discord';
    }
}
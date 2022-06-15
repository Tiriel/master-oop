<?php

namespace App\Notifier\Factory;

use Symfony\Component\Notifier\Notification\Notification;

interface NotificationFactoryInterface
{
    public function getNotification(string $message): Notification;

    public static function getDefaultIndexName(): string;
}
<?php

namespace App\Notifier\Factory;

use App\Notifier\Notifications\MailNotification;
use Symfony\Component\Notifier\Notification\Notification;

class MailNotificationFactory implements IterableNotificationFactoryInterface
{

    public function getNotification(string $message): Notification
    {
        return new MailNotification($message);
    }

    public static function getDefaultIndexName(): string
    {
        return 'mail';
    }
}
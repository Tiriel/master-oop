<?php

namespace App\Notifier\Factory;

use App\Notifier\Notifications\FirebaseNotification;
use Symfony\Component\Notifier\Notification\Notification;

class FirebaseNotificationFactory implements IterableNotificationFactoryInterface
{

    public function getNotification(string $message): Notification
    {
        return new FirebaseNotification($message);
    }

    public static function getDefaultIndexName(): string
    {
        return 'firebase';
    }
}
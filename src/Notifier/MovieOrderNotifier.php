<?php

namespace App\Notifier;

use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;

class MovieOrderNotifier
{
    public function __construct(
        private NotifierInterface $notifier
    ){}

    public function sendNotification(string $channel, string $message): bool
    {
        // TODO: Rework to instantiate proper notification according to channel
        $notification = new Notification();
        $this->notifier->send($notification);

        return true;
    }
}
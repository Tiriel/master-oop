<?php

namespace App\Notifier;

use App\Notifier\Factory\NotificationFactoryInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;

class MovieOrderNotifier
{
    public function __construct(
        private iterable $factories,
        private NotifierInterface $notifier
    ){
        /** @var NotificationFactoryInterface[] factories */
        $this->factories = $this->factories instanceof \Traversable ? iterator_to_array($this->factories) : $this->factories;
    }

    public function sendNotification(string $channel, string $message): bool
    {
        $notification = $this->factories[$channel]->getNotification();
        $this->notifier->send($notification);

        return true;
    }
}
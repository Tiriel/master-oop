<?php

namespace App\Notifier\Factory;

use Symfony\Component\Notifier\Notification\Notification;

class ChainNotificationFactory implements NotificationFactoryInterface
{
    private iterable $factories;

    public function __construct(iterable $factories)
    {
        /** @var IterableNotificationFactoryInterface factories */
        $this->factories = $factories instanceof \Traversable ? iterator_to_array($factories) : $factories;
    }

    public function getNotification(string $message, string $channel = ''): Notification
    {
        if ('' === $channel) {
            throw new \RuntimeException();
        }

        return $this->factories[$channel]->getNotification($message);
    }
}
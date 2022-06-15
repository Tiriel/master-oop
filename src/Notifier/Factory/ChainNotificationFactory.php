<?php

namespace App\Notifier\Factory;

use Symfony\Component\Notifier\Notification\Notification;

class ChainNotificationFactory implements NotificationFactoryInterface
{
    public function __construct(private iterable $factories)
    {
        /** @var IterableNotificationFactoryInterface factories */
        $this->factories = $this->factories instanceof \Traversable ? iterator_to_array($this->factories) : $this->factories;
    }

    public function getNotification(string $message, string $channel = ''): Notification
    {
        if ('' === $channel) {
            throw new \RuntimeException();
        }

        return $this->factories[$channel]->getNotification($message);
    }
}
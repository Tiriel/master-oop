<?php

namespace App\Notifier;

use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;

class MovieOrderNotifier
{
    private iterable $factories;
    private NotifierInterface $notifier;

    public function __construct(iterable $factories, NotifierInterface $notifier)
    {
        $this->factories = $factories instanceof \Traversable ? iterator_to_array($factories) : $factories;
        $this->notifier = $notifier;
    }

    public function sendNotification(string $channel, string $message): bool
    {
        $notification = $this->factories[$channel]->getNotification();
        $this->notifier->send($notification);

        return true;
    }
}
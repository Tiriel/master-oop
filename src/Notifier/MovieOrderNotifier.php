<?php

namespace App\Notifier;

use App\Notifier\Factory\ChainNotificationFactory;
use Symfony\Component\Notifier\NotifierInterface;

class MovieOrderNotifier
{
    public function __construct(
        private NotifierInterface $notifier,
        private ChainNotificationFactory $factory
    ){}

    public function sendNotification(string $channel, string $message): bool
    {
        $notification = $this->factory->getNotification($message, $channel);
        $this->notifier->send($notification);

        return true;
    }
}
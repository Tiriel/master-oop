<?php

namespace App\Notifier\Notifications;

use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\Notification\SmsNotificationInterface;
use Symfony\Component\Notifier\Recipient\SmsRecipientInterface;

class FirebaseNotification extends Notification implements SmsNotificationInterface
{

    public function asSmsMessage(SmsRecipientInterface $recipient, string $transport = null): ?SmsMessage
    {
        return new SmsMessage($recipient->getPhone(), '');
    }
}
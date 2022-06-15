<?php

namespace App\Notifier\Factory;

interface IterableNotificationFactoryInterface extends NotificationFactoryInterface
{
    public static function getDefaultIndexName(): string;
}
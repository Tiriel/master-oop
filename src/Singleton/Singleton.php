<?php

namespace App\Singleton;

class Singleton
{
    private static Singleton $instance;

    private function __construct() {}

    private function __clone(): void {}

    public static function getInstance(): Singleton
    {
        return self::$instance ?? self::$instance = new static();
    }
}
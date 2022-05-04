<?php

namespace App\Consumer;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OMDbApiConsumer
{
    public const MODE_ID = 'i';
    public const MODE_SEARCH = 's';
    public const MODE_TITLE = 't';

    public function __construct(
        private HttpClientInterface $omdbClient
    ) {}

    public function consume(string $type, string $value) : array
    {
        if (!\in_array($type, [self::MODE_ID, self::MODE_SEARCH, self::MODE_TITLE])) {
            throw new \InvalidArgumentException(sprintf("Invalid mode provided for consumer : %s, %s, or %s allowed, %s given",
                self::MODE_ID, self::MODE_SEARCH, self::MODE_TITLE, $type));
        }

        return $this->omdbClient
            ->request(Request::METHOD_GET, '', ['query' => [$type => $value]])
            ->toArray();
    }
}
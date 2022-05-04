<?php

namespace App\Events;

use App\Entity\Book;
use Symfony\Contracts\EventDispatcher\Event;

class BookEvent extends Event
{
    public const NAME = 'book.published';

    public function __construct(private Book $book) {}

    public function getBook(): Book
    {
        return $this->book;
    }
}
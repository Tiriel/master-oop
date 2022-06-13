<?php

namespace App\Events;

use App\Entity\Book;
use Symfony\Contracts\EventDispatcher\Event;

class BookEvent extends Event
{
    public const NAME = 'book.published';
    private Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function getBook(): Book
    {
        return $this->book;
    }
}
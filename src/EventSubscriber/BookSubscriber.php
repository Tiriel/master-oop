<?php

namespace App\EventSubscriber;

use App\Events\BookEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Twig\TemplateWrapper;

class BookSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig
    ) {}

    public function onBookPublished($event)
    {
        if (!$event instanceof BookEvent) {
            return;
        }

        $book = $event->getBook();
        $mail = (new Email())
            ->subject('A new book was published!')
            ->to('admin@sensiotv.foo')
            ->html(
                $this->twig->render('mail/book_published.html.twig', ['book' => $book])
            )
        ;
        $this->mailer->send($mail);
    }

    public static function getSubscribedEvents()
    {
        return [
            BookEvent::NAME => 'onBookPublished',
        ];
    }
}

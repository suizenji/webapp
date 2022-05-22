<?php

namespace App\EventSubscriber;

use App\Event\FooEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @see https://q.agency/blog/custom-events-with-symfony5
 */
class FooSubscriber implements EventSubscriberInterface
{
    public static $count = 0;

    public function onFooAction(FooEvent $event): void
    {
        return;

        var_dump(self::$count++);
        var_dump($event->getContext());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FooEvent::NAME => 'onFooAction',
        ];
    }
}

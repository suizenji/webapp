<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * @see https://symfony.com/doc/current/event_dispatcher.html
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::EXCEPTION => [
                ['processException', 10],
                ['logException', 0],
                ['notifyException', -10],
            ],
        ];
    }

    public function processException(ExceptionEvent $event)
    {
        var_dump(__FUNCTION__);
    }

    public function logException(ExceptionEvent $event)
    {
        var_dump(__FUNCTION__);
    }

    public function notifyException(ExceptionEvent $event)
    {
        var_dump(__FUNCTION__);
    }
}

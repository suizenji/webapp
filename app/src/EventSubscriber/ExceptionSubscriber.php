<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

/**
 * @see https://symfony.com/doc/current/event_dispatcher.html
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
    const PATH_PAGES_ERROR = 'bundles/TwigBundle/Exception/';

    public function __construct(private Environment $twig)
    {
    }

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
        return;
        /*
        $template = self::PATH_PAGES_ERROR . 'error.html.twig';
        $content = $this->twig->render($template);

        $response = new Response();
        $response->setContent($content);

        $event->setResponse($response);
        */
    }
}

<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

/**
 * @link https://symfony.com/doc/current/the-fast-track/ja/12-event.html
 */
class TwigSubscriber implements EventSubscriberInterface
{
    public function __construct(private Environment $twig)
    {
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $this->twig->addGlobal('bark', 'myao');
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}

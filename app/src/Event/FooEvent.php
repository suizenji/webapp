<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class FooEvent extends Event
{
    public const NAME = 'user.foo';

    public function __construct(private $context)
    {
    }

    public function getContext()
    {
        return $this->context;
    }
}

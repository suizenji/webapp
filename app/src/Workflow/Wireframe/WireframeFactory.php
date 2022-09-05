<?php

namespace App\Workflow\Wireframe;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Workflow\Registry;

class WireframeFactory implements WireframeFactoryInterface
{
    public function __construct(
        private Registry $workflows,
        private RequestStack $requestStack,
    ) {
    }

    public function create($name): WireframeInterface
    {
        return new Wireframe($this->workflows, $this->requestStack, $name);
    }
}

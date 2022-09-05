<?php

namespace App\Workflow\Wireframe;

interface WireframeFactoryInterface
{
    public function create($name): WireframeInterface;
}

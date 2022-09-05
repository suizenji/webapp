<?php

namespace App\Workflow\Wireframe;

interface WireframeInterface
{
    public function getEntity();

    public function setEntity($entity);

    public function isValid($to);

    public function update($to);

    public function reset();
}

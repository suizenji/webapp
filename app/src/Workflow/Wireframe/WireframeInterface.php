<?php

namespace App\Workflow\Wireframe;

interface WireframeInterface
{
    public function getEntity($name);

    public function setEntity($name, $entity);

    public function isValid($name, $to);

    public function update($name, $to);

    public function reset($name);
}

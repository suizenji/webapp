<?php

namespace App\Workflow\Entity;

class Wireframe
{
    private $currentPlace;

    public function getCurrentPlace()
    {
        return $this->currentPlace;
    }

    public function setCurrentPlace($currentPlace, $context = [])
    {
        $this->currentPlace = $currentPlace;
    }
}

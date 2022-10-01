<?php

namespace App\Service;

class Foo
{
    public function __construct(private $projectDir)
    {
    }

    public function run()
    {
        return $this->projectDir;
    }
}

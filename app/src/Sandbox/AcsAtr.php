<?php

namespace App\Sandbox;

use App\Traits\AccessorAttr;

class AcsAtr
{
    use AccessorAttr;

    #[Getter]
    #[Setter]
    private ?int $priInt = null;
}

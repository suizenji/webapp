<?php

namespace App\Sandbox;

use App\Traits\AccessorAttrTrait;

class AccessorAttr
{
    use AccessorAttrTrait;

    #[Getter]
    #[Setter]
    private ?int $priInt = null;
}

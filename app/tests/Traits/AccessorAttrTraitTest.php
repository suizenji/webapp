<?php

namespace App\Tests\Traits;

use App\Traits\AccessorAttrTrait;
use PHPUnit\Framework\TestCase;

class AccessorAttrTraitTest extends TestCase
{
    public function testAccessor(): void
    {
        $obj = new AccessorAttr();

        $obj->set('onAttr', true);
        $this->assertTrue($obj->get('onAttr'), 'Accessor');

        $this->expectExceptionMessage('Getter attr is not setted.');
        $obj->get('offAttr');

        $this->expectExceptionMessage('Setter attr is not setted.');
        $obj->set('offAttr', 'something');
    }

    public function testAttrOverwriteOn(): void
    {
        $obj = new AccessorAttrChild();

        $obj->set('offAttr', true);
        $this->assertTrue($obj->get('offAttr'));

        $this->expectExceptionMessage('Setter attr is not setted.');
        $obj->set('onAttr', 'something');
    }
}

class AccessorAttr
{
    use AccessorAttrTrait;

    #[Getter]
    #[Setter]
    public $onAttr;

    public $offAttr;
}

class AccessorAttrChild extends AccessorAttr
{
    public $onAttr;

    #[Getter, Setter]
    public $offAttr;
}

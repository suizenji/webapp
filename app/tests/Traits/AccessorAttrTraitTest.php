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
        $this->assertTrue($obj->get('onAttr'));
    }

    public function testAttrGetter(): void
    {
        $this->expectExceptionMessage('Getter attr is not setted.');
        $obj = new AccessorAttr();
        $obj->get('offAttr');
    }

    public function testAttrSetter(): void
    {
        $this->expectExceptionMessage('Setter attr is not setted.');
        $obj = new AccessorAttr();
        $obj->set('offAttr', true);
    }

    public function testAttrOverwriteOn(): void
    {
        $this->expectExceptionMessage('Setter attr is not setted.');
        $obj = new AccessorAttrChild();
        $obj->set('onAttr', true);
    }

    public function testAttrOverwriteOff(): void
    {
        $obj = new AccessorAttrChild();
        $obj->set('offAttr', true);
        $this->assertTrue($obj->get('offAttr'));
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

    #[Getter]
    #[Setter]
    public $offAttr;
}

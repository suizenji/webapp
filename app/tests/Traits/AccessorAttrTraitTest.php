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

    public function testAccessorChild(): void
    {
        $obj = new AccessorAttrChild();
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
        $obj->set('offAttr', 1);
    }

    public function testAttrOverwrite(): void
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
    #[Getter]
    #[Setter]
    public $offAttr;
}

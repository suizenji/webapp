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

        try {
            $obj->get('offAttr');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $this->assertEquals('Getter attr is not setted.', $msg);
        }

        try {
            $obj->set('offAttr', 'something');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $this->assertEquals('Setter attr is not setted.', $msg);
        }


        $obj->set('onArg', 'something');
        $this->assertEquals($obj->get('onArg'), 'overwrite');

        try {
            $obj->get('offArg');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $this->assertEquals("method 'getFoo' is not found.", $msg);
        }

        try {
            $obj->set('offArg', 'something');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $this->assertEquals("method 'setFoo' is not found.", $msg);
        }
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

    #[Getter('getOnArg'), Setter('setOnArg')]
    public $onArg;

    #[Getter('getFoo'), Setter('setFoo')]
    public $offArg;

    public function getOnArg()
    {
        return $this->onArg . 'write';
    }

    public function setOnArg($value)
    {
        $this->onArg = 'over';
    }
}

class AccessorAttrChild extends AccessorAttr
{
    public $onAttr;

    #[Getter, Setter]
    public $offAttr;
}

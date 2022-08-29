<?php

namespace App\Tests\Traits;

use App\Traits\AccessorAttrTrait;
use PHPUnit\Framework\TestCase;

class AccessorAttrTraitTest extends TestCase
{
    public function testBasic(): void
    {
        $obj = new AccessorAttr();

        $obj->set('onAttr', true);
        $this->assertTrue($obj->get('onAttr'), 'Accessor');

        try {
            $obj->get('offAttr');
            throw new \RuntimeException('Exception is not happen.');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $this->assertEquals('Getter attr is not setted.', $msg);
        }

        try {
            $obj->set('offAttr', 'something');
            throw new \RuntimeException('Exception is not happen.');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $this->assertEquals('Setter attr is not setted.', $msg);
        }

        $obj->set('onArg', 'something');
        $this->assertEquals($obj->get('onArg'), 'overwrite');

        try {
            $obj->get('offArg');
            throw new \RuntimeException('Exception is not happen.');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $this->assertEquals("method 'getFoo' is not found.", $msg);
        }

        try {
            $obj->set('offArg', 'something');
            throw new \RuntimeException('Exception is not happen.');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $this->assertEquals("method 'setFoo' is not found.", $msg);
        }
    }

    public function testExtends(): void
    {
        $obj = new AccessorAttrChild();

        $obj->set('offAttr', true);
        $this->assertTrue($obj->get('offAttr'));

        try {
            $obj->set('onAttr', 'something');
            throw new \RuntimeException('Exception is not happen.');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $this->assertEquals('Setter attr is not setted.', $msg);
        }

        $obj->set('onArg', 'something');
        $this->assertEquals($obj->get('onArg'), 'underwrite');
    }

    public function testClass(): void
    {
        $obj = new AccessorClassAttr();

        $obj->set('valClass', true);
        $this->assertTrue($obj->get('valClass'));

        $obj->set('valProp', true);
        $this->assertEquals($obj->get('valProp'), 'overwrite');


        $obj = new AccessorClassAttrRev();

        $obj->set('valClass', true);
        $this->assertTrue($obj->get('valClass'));

        $obj->set('valProp', true);
        $this->assertEquals($obj->get('valProp'), 'overwrite');
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

    public function setOnArg($value)
    {
        $this->onArg = 'under';
    }
}

#[Getter]
#[Setter]
class AccessorClassAttr
{
    use AccessorAttrTrait;

    public $valClass;

    #[Getter('getValProp')]
    #[Setter('setValProp')]
    public $valProp;

    public function getValProp()
    {
        return $this->valProp . 'write';
    }

    public function setValProp($value)
    {
        $this->valProp = 'over';
    }
}

#[Getter('getValProp')]
#[Setter('setValProp')]
class AccessorClassAttrRev
{
    use AccessorAttrTrait;

    #[Getter]
    #[Setter]
    public $valClass;

    public $valProp;

    public function getValProp()
    {
        return $this->valProp . 'write';
    }

    public function setValProp($value)
    {
        $this->valProp = 'over';
    }
}

<?php

namespace App\Tests;

use App\Service\Foo;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FooTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $foo = static::getContainer()->get(Foo::class);
        echo $foo->run();
    }
}

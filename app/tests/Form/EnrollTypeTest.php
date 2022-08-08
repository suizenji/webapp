<?php

namespace App\Tests\Form;

use App\Entity\Member;
use App\Form\EnrollType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class EnrollTypeTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $container = static::getContainer();

        $formData = [
            'enroll' => [
                'email' => 'test@domain.com',
                'plain_password' => 'pass1234',
            ],
        ];

        $request = Request::create('/', 'POST', $formData);

        $member = new Member();
        $form = $container->get('form.factory')->create(EnrollType::class, $member, [
            'csrf_protection' => false,
        ]);

        $form->handleRequest($request);
        $this->assertTrue($form->isSubmitted(), 'NG Submit');
        $this->assertTrue($form->isValid(), 'Invalid form');
    }
}

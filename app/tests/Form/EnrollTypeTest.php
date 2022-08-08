<?php

namespace App\Tests\Form;

use App\Entity\Member;
use App\Form\EnrollType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class EnrollTypeTest extends KernelTestCase
{
    public function testOK(): void
    {
        $form = $this->submitForm(EnrollType::class, new Member(), [
            'email' => 'name@domain.com',
            'plain_password' => 'pass1234',
        ]);

        $this->assertTrue($form->isSubmitted());
        $this->assertTrue($form->isValid());
    }

    public function testNG(): void
    {
        $form = $this->submitForm(EnrollType::class, new Member(), [
            'email' => 'name@domain.com',
            'plain_password' => 'pass123',
        ]);

        $this->assertTrue($form->isSubmitted());
        $this->assertFalse($form->isValid());
        $this->assertEquals('under', $form->getErrors()[0]->getMessage());
    }

    protected function createForm($type, $entity): Form
    {
        return static::getContainer()->get('form.factory')->create($type, $entity, [
            'csrf_protection' => false,
        ]);
    }

    protected function submitForm($type, $entity, $data): Form
    {
        $request = Request::create('/', 'POST', [
            'enroll' => $data,
        ]);

        $form = $this->createForm($type, $entity);
        $form->handleRequest($request);

        return $form;
    }
}

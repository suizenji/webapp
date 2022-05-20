<?php

namespace App\Tests\Controller;

use App\DataFixtures\MemberFixtures;
use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testVisiting(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertSelectorTextContains('#login', 'sign up');
    }

    public function testVisitingWhileLoggedIn(): void
    {
        $client = static::createClient();
        $memberRepository = static::getContainer()->get(MemberRepository::class);
        $testUser = $memberRepository->findOneByEmail(MemberFixtures::EMAIL);

        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/login');

        $this->assertSelectorTextContains('#logout', 'Logout');
    }

    public function testLoginForm(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $crawler = $client->submitForm('Sign in', [
            'email' => MemberFixtures::EMAIL,
            'password' => MemberFixtures::PW,
        ]);

        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains('#logout', 'Logout');
    }
}

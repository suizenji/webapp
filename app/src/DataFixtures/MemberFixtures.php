<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MemberFixtures extends Fixture
{
    public const EMAIL = 'email@email.com';
    public const PW = 'Passw0rd';

    public function __construct(
        private UserPasswordHasherInterface $pwh
    ) {
        // do nothing
    }

    public function load(ObjectManager $manager)
    {
        $member = new Member();

        $hashedPassword = $this->pwh->hashPassword($member, self::PW);

        $member->setEmail(self::EMAIL);
        $member->setPassword($hashedPassword);

        $manager->persist($member);
        $manager->flush();
    }
}

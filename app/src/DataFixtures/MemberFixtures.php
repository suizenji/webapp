<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MemberFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $pwh
    ) {
        // do nothing
    }

    public function load(ObjectManager $manager)
    {
        $member = new Member();

        $hashedPassword = $this->pwh->hashPassword($member, 123);

        $member->setEmail('email@test.com');
        $member->setPassword($hashedPassword);

        $manager->persist($member);
        $manager->flush();
    }
}

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

    public const DATA_LIST = [
        [self::EMAIL, self::PW],
    ];

    public function __construct(
        private UserPasswordHasherInterface $pwh
    ) {
        // do nothing
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA_LIST as $data) {
            $member = new Member();
            $member->setEmail($data[0]);

            $hashedPassword = $this->pwh->hashPassword($member, $data[1]);
            $member->setPassword($hashedPassword);

            $manager->persist($member);
            $manager->flush();
        }
    }
}

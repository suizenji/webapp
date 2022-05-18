<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MemberFixtures extends Fixture
{
    //    public function load(ObjectManager $manager, UserPasswordHasherInterface $pwh): void
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $member = new Member();

        //        $hashedPassword = $pwh->hashPassword($member, 123);
        $hashedPassword = 213;

        $member->setEmail('email@test.com');
        $member->setPassword($hashedPassword);

        $manager->persist($member);
        $manager->flush();
    }
}

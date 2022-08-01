<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public const DATA_LIST = [
        ['email@email.com', true, 'first content'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATA_LIST as $data) {
            $post = new Post();
            $post->setEditor($data[0]);
            $post->setPublic($data[1]);
            $post->setContent($data[2]);
            $post->setCreatedAt(new \DateTimeImmutable());
            $post->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($post);
            $manager->flush();
        }
    }
}

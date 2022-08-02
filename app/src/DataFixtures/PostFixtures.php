<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public const DATA_LIST = [
        ['email@email.com', true, 'public title',  'first content'],
        ['email@email.com', false, 'private title', 'priv content'],
        ['foo@bar.com', true, 'foobar', 'hogefuga'],
        ['email@email.com', true, 'Lorem Ipsum', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATA_LIST as $data) {
            $post = new Post();
            $post->setEditor($data[0]);
            $post->setIsPublic($data[1]);
            $post->setTitle($data[2]);
            $post->setContent($data[3]);
            $post->setCreatedAt(new \DateTimeImmutable());
            $post->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($post);
            $manager->flush();
        }
    }
}

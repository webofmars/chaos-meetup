<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\PollVotes;

class PollVotesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $pollVote = new PollVotes();
        $pollVote->setAnimal('singe');
        $pollVote->setVotes(0);
        $manager->persist($pollVote);
        $manager->flush();

        $pollVote = new PollVotes();
        $pollVote->setAnimal('ornithorynque');
        $pollVote->setVotes(0);
        $manager->persist($pollVote);
        $manager->flush();
    }
}

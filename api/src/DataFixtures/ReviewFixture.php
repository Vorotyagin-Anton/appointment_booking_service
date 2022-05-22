<?php

namespace App\DataFixtures;

use App\Entity\Career;
use App\Entity\Rating;
use App\Entity\Review;
use App\Entity\Service;
use App\Entity\User;
use App\Entity\WorkerAvailableTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ReviewFixture extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct(
        private EntityManagerInterface $em
    )
    {
        $this->faker = Factory::create();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $workers = $this->em->getRepository(User::class)->findBy(['isWorker' => true]);
        $clients = $this->em->getRepository(User::class)->findBy(['isClient' => true]);
        $firstReviewer = $clients[array_rand($clients)];
        $secondReviewer = $clients[array_rand($clients)];

        foreach ($workers as $worker) {
            $review = new Review();
            $review->setScore($this->faker->numberBetween(0, 10));
            $review->setDate($this->faker->dateTimeBetween('-5 years', '-1 month'));
            $review->setText($this->faker->text());
            $review->setWorker($worker);
            $firstReviewer->addReview($review);
            $worker->addGettedReview($review);
            $manager->persist($review);

            $review = new Review();
            $review->setScore($this->faker->numberBetween(0, 10));
            $review->setDate($this->faker->dateTimeBetween('-5 years', '-1 month'));
            $review->setText($this->faker->text());
            $review->setWorker($worker);
            $secondReviewer->addReview($review);
            $worker->addGettedReview($review);
            $manager->persist($review);
        }

        $manager->flush();
    }
}

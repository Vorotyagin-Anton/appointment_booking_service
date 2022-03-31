<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class UserFixture extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->getQuote());
        }
        $manager->flush();
    }

    private function getQuote(): User
    {
        $user = new User(
            $this->faker->lastName(),
            $this->faker->firstName(),
            $this->faker->firstName()
        );

        $fakerBoolean = $this->faker->boolean();

        $user->setIsClient($fakerBoolean);
        $user->setIsWorker(!$fakerBoolean);
        $user->setPathToPhoto('/public/uploads/photo/dummy.jpg');

        return $user;
    }
}

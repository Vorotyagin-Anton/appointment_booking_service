<?php

namespace App\DataFixtures;

use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->faker = Factory::create();
        $this->em = $em;
    }

    public function getDependencies(): array
    {
        return [
            ServiceFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->getUser());
        }
        $manager->flush();
    }

    private function getUser(): User
    {
        $service = $this->em->getRepository(Service::class)->findAll();

        $user = new User(
            $this->faker->lastName(),
            $this->faker->firstName(),
            $this->faker->firstName()
        );

        $fakerBoolean = $this->faker->boolean();

        $user->setIsClient($fakerBoolean);
        $user->setIsWorker(!$fakerBoolean);
        $user->setPathToPhoto('/uploads/photo/dummy.jpg');

        $user->setServices([
            $service[array_rand($service)],
            $service[array_rand($service)],
            $service[array_rand($service)],
        ]);

        return $user;
    }
}

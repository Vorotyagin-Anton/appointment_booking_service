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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {
        $this->faker = Factory::create();
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;
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

        $manager->persist($this->getWorkerWithCredentials());

        $manager->flush();
    }

    private function getUser(): User
    {
        $service = $this->em->getRepository(Service::class)->findAll();

        $user = new User();

        $user->setSurname($this->faker->lastName());
        $user->setName($this->faker->firstName());
        $user->setMiddlename($this->faker->firstName());

        $fakerBoolean = $this->faker->boolean();

        $user->setIsClient($fakerBoolean);
        $user->setIsWorker(!$fakerBoolean);
        $user->setPathToPhoto('/uploads/photo/dummy.jpg');
        $user->setStory($this->faker->text());

        $user->setServices([
            $service[array_rand($service)],
            $service[array_rand($service)],
            $service[array_rand($service)],
        ]);

        return $user;
    }

    private function getWorkerWithCredentials(): User
    {
        $service = $this->em->getRepository(Service::class)->findAll();

        $user = new User(
            $this->faker->lastName(),
            $this->faker->firstName(),
            $this->faker->firstName()
        );

        $user->setIsClient(false);
        $user->setIsWorker(true);
        $user->setPathToPhoto('/uploads/photo/dummy.jpg');
        $user->setStory($this->faker->text());

        $user->setServices([
            $service[array_rand($service)],
            $service[array_rand($service)],
            $service[array_rand($service)],
        ]);

        $user->setEmail('test@test.com');
        $password = 'test';

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);

        return $user;
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Service;
use App\Entity\User;
use App\Entity\WorkerAvailableTime;
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

        $manager->persist($this->getAdmin());

        $manager->flush();
    }

    private function getUser(): User
    {
        $user = new User();

        $user->setEmail($this->faker->email());
        $user->setSurname($this->faker->lastName());
        $user->setName($this->faker->firstName());
        $user->setMiddlename($this->faker->firstName());

        $fakerBoolean = $this->faker->boolean();

        $user->setIsClient($fakerBoolean);
        $user->setIsWorker(!$fakerBoolean);
        $user->setPathToPhoto('/uploads/photo/dummy.jpg');
        $user->setStory($this->faker->text());

        if ($user->getIsClient()) {
            $user->setRoles(['ROLE_CLIENT']);
        }

        $service = $this->em->getRepository(Service::class)->findAll();
        $workerAvailableTimeVariants = [540, 600, 660, 720, 780, 840, 900, 960, 1020, 1080];
        if ($user->getIsWorker()) {
            $user->setRoles(['ROLE_WORKER']);

            $user->addService($service[array_rand($service)]);
            $user->addService($service[array_rand($service)]);
            $user->addService($service[array_rand($service)]);

            foreach ($workerAvailableTimeVariants as $availableTime) {
                $workerAvailableTime = new WorkerAvailableTime();
                $workerAvailableTime->setExactTimeInMinutes($availableTime);
                $workerAvailableTime->setIsTimeFree(true);
                $user->addWorkerAvailableTime($workerAvailableTime);
            }
        }

        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                '123'
            )
        );

        return $user;
    }

    private function getAdmin(): User
    {
        $service = $this->em->getRepository(Service::class)->findAll();

        $user = new User();

        $user->setSurname($this->faker->lastName());
        $user->setName($this->faker->firstName());
        $user->setMiddlename($this->faker->firstName());
        $user->setIsClient(false);
        $user->setIsWorker(false);
        $user->setPathToPhoto('/uploads/photo/dummy.jpg');
        $user->setRoles(['ROLE_ADMIN']);

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

<?php

namespace App\DataFixtures;

use App\Entity\Rating;
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

class UserFixture extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    private array $fakeImagePaths;

    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $passwordHasher,
        private ParameterBagInterface $parameterBag
    )
    {
        $this->faker = Factory::create();
        $this->fillFakeImagePaths();
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

    private function fillFakeImagePaths(): void
    {
        $finder = new Finder();
        $relativePathToFakeImage = '/uploads/photo/fake_image';
        $absolutePathToFakeImage = $this->parameterBag->get('kernel.project_dir') . '/public' . $relativePathToFakeImage;
        $finder->files()->in($absolutePathToFakeImage);
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $this->fakeImagePaths[] = $relativePathToFakeImage . '/' . $file->getRelativePathname();
            }
        }
    }

    private function getUser(): User
    {
        $user = new User();

        $user->setEmail($this->faker->email());
        $user->setMobilePhoneNumber('7' . $this->faker->numberBetween(100000000, 999999999));
        $user->setSurname($this->faker->lastName());
        $user->setName($this->faker->firstName());
        $user->setMiddlename($this->faker->firstName());

        $fakerBoolean = $this->faker->boolean();

        $user->setIsClient($fakerBoolean);
        $user->setIsWorker(!$fakerBoolean);
        $user->setPathToPhoto(\array_pop($this->fakeImagePaths));
        $user->setStory($this->faker->text());

        if ($user->getIsClient()) {
            $user->setRoles(['ROLE_CLIENT']);
        }

        $service = $this->em->getRepository(Service::class)->findAll();
        $workerAvailableTimeVariants = [540, 600, 660, 720, 780, 840, 900, 960, 1020, 1080];
        $workerAvailableDates = [];
        for ($i = 0; $i < 50; $i++) {
            $workerAvailableDates[] = $this->faker->dateTimeBetween('-3 months', '+3 month');
        }
        $workerAvailableDates = array_unique($workerAvailableDates, SORT_REGULAR);
        if ($user->getIsWorker()) {
            $user->setRoles(['ROLE_WORKER']);

            $user->addService($service[array_rand($service)]);
            $user->addService($service[array_rand($service)]);
            $user->addService($service[array_rand($service)]);

            foreach ($workerAvailableDates as $workerAvailableDate) {
                foreach ($workerAvailableTimeVariants as $availableTime) {
                    $workerAvailableTime = new WorkerAvailableTime();
                    $workerAvailableTime->setExactDate($workerAvailableDate);
                    $workerAvailableTime->setExactTimeInMinutes($availableTime);
                    $workerAvailableTime->setIsTimeFree($this->faker->boolean(75));
                    $user->addWorkerAvailableTime($workerAvailableTime);
                }
            }

            $rating = new Rating();
            $rating->setScore($this->faker->numberBetween(0, 10));
            $rating->setVoices($this->faker->numberBetween(0, 1000));

            $user->setRating($rating);
        }

        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                '123123123'
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
        $user->setPathToPhoto(\array_pop($this->fakeImagePaths));
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

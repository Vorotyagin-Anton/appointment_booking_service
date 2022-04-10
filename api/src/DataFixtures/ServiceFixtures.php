<?php

namespace App\DataFixtures;

use App\Entity\Service;
use App\Entity\ServiceCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ServiceFixtures extends Fixture implements DependentFixtureInterface
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
            ServiceCategoryFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->getService());
        }
        $manager->flush();
    }

    private function getService(): Service
    {
        $serviceCategoryFixtures = $this->em->getRepository(ServiceCategory::class)->findAll();

        $service = new Service();

        $service->setName($this->faker->city());
        $service->setPathToPhoto('/uploads/photo/dummy.jpg');
        $service->setCategory([$serviceCategoryFixtures[array_rand($serviceCategoryFixtures)]]);

        return $service;
    }
}

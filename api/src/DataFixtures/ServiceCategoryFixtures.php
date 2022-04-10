<?php

namespace App\DataFixtures;

use App\Entity\ServiceCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ServiceCategoryFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $manager->persist($this->getServiceCategory());
        }
        $manager->flush();
    }

    private function getServiceCategory(): ServiceCategory
    {
        $serviceCategory = new ServiceCategory();

        $serviceCategory->setName($this->faker->country());
        $serviceCategory->setPathToPhoto('/uploads/photo/dummy.jpg');

        return $serviceCategory;
    }
}

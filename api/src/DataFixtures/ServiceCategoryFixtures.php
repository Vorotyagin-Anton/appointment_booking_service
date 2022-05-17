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
        $serviceCategoriesData = [
            'hair salons' => '/uploads/photo/service_categories/hair_and_beauty.webp',
            'barbershops' => '/uploads/photo/service_categories/barber_shop.webp',
            'beauty and nail salons' => '/uploads/photo/service_categories/spas_nails_salons.webp',
            'personal training' => '/uploads/photo/service_categories/personal_training.webp',
            'health and wellness' => '/uploads/photo/service_categories/health_wellness.webp',
            'professional services' => '/uploads/photo/service_categories/professional.webp',
            'home repair and cleaning' => '/uploads/photo/service_categories/home_repair.webp',
            'tutoring and music lessons' => '/uploads/photo/service_categories/tutoring_music.webp',
        ];

        foreach ($serviceCategoriesData as $serviceName => $servicePhoto) {
            $serviceCategory = new ServiceCategory();
            $serviceCategory->setName($serviceName);
            $serviceCategory->setPathToPhoto($servicePhoto);
            $manager->persist($serviceCategory);
        }
        $manager->flush();
    }
}

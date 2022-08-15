<?php

namespace App\DataFixtures;

use App\Entity\Service;
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
            ['name' => 'hair salons', 'pathToPhoto' => '/uploads/photo/service_categories/hair_and_beauty.webp', 'services' => [
                'hairdresser', 'stylist', 'model'
            ]],
            ['name' => 'barbershops', 'pathToPhoto' => '/uploads/photo/service_categories/barber_shop.webp', 'services' => [
                'hairdresser for man', 'stylist for man', 'barber'
            ]],
            ['name' => 'beauty and nail salons', 'pathToPhoto' => '/uploads/photo/service_categories/spas_nails_salons.webp', 'services' => [
                'manicure', 'pedicure', 'cosmetologist', 'consulting', 'tattoo and piercing', 'hair removal'
            ]],
            ['name' => 'personal training', 'pathToPhoto' => '/uploads/photo/service_categories/personal_training.webp', 'services' => [
                'masseur', 'trainer', 'instructor'
            ]],
            ['name' => 'health and wellness', 'pathToPhoto' => '/uploads/photo/service_categories/health_wellness.webp', 'services' => [
                'nutritionist', 'speech therapist', 'massage therapist', 'psychologist'
            ]],
            ['name' => 'professional services', 'pathToPhoto' => '/uploads/photo/service_categories/professional.webp', 'services' => [
                'research', 'marketing', 'advertising', 'surveys', 'translator'
            ]],
            ['name' => 'home repair and cleaning', 'pathToPhoto' => '/uploads/photo/service_categories/home_repair.webp', 'services' => [
                'domestic services', 'housekeeping', 'governess', 'nanny', 'caretaker', 'cleaning'
            ]],
            ['name' => 'tutoring and music lessons', 'pathToPhoto' => '/uploads/photo/service_categories/tutoring_music.webp', 'services' => [
                'vocal coach', 'guitar', 'piano'
            ]]
        ];

        foreach ($serviceCategoriesData as $serviceCategoryData) {
            $serviceCategory = new ServiceCategory();
            $serviceCategory->setName($serviceCategoryData['name']);
            $serviceCategory->setPathToPhoto($serviceCategoryData['pathToPhoto']);
            $manager->persist($serviceCategory);

            foreach ($serviceCategoryData['services'] as $serviceName) {
                $service = new Service();
                $service->setName($serviceName);
                $service->setPathToPhoto($serviceCategoryData['pathToPhoto']);
                $service->addCategory($serviceCategory);
                $manager->persist($service);
            }
        }
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->faker = Factory::create();
        $this->em = $em;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->getQuote());
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }

    private function getQuote(): Order
    {
        $clients = $this->em->getRepository(User::class)->findBy(['isClient' => true]);
        $workers = $this->em->getRepository(User::class)->findBy(['isWorker' => true]);

        $order = new Order(
            $clients[array_rand($clients)],
            $workers[array_rand($workers)]
        );

        $dt = $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+60 days');
        $date = $dt->format("Y-m-d");

        $date = new \DateTime($date);
        $time = new \DateTime($this->faker->time('H:i'));
        $serviceType = rand(0, 1000);
        $details = $this->faker->text(100);

        $order->setExecutionDate($date);
        $order->setExecutionTime($time);
        $order->setServiceType($serviceType);
        $order->setDetails($details);
        $order->setClientContactType(1);
        $order->setStatus(1);

        return $order;
    }
}

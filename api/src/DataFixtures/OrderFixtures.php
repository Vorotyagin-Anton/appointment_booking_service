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

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 100; $i++) {
            $manager->persist($this->getOrder());
        }
        $manager->flush();
    }

    private function getOrder(): Order
    {
        $clients = $this->em->getRepository(User::class)->findBy(['isClient' => true]);
        $workers = $this->em->getRepository(User::class)->findBy(['isWorker' => true]);

        $randomClient = $clients[array_rand($clients)];
        $randomWorker = $workers[array_rand($workers)];

        $services = $randomWorker->getServices()->toArray();
        $randomService = $services[array_rand($services)];

        $times = $randomWorker->getAvailableTimes()->toArray();
        $randomTime = $times[array_rand($times)];

        $order = new Order();
        $order->setClient($randomClient);
        $order->setClientName($randomClient->getName());
        $order->setClientEmail($randomClient->getEmail());
        $order->setClientPhone($randomClient->getMobilePhoneNumber());
        $order->setClientTelegram($randomClient->getTelegram());
        $order->setClientContactType($this->faker->numberBetween(1, 3));

        $order->setWorker($randomWorker);
        $order->setService($randomService);
        $order->addTime($randomTime);

        $order->setDetails($this->faker->text(100));
        $order->setStatus($this->faker->numberBetween(1, 10));

        return $order;
    }
}

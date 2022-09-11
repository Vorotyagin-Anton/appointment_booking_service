<?php

namespace App\DataFixtures;

use App\Entity\ContactType;
use App\Entity\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $orderStatusNames = [
            1 => 'pending',
            2 => 'awaiting payment',
            3 => 'awaiting fulfillment',
            4 => 'completed',
            5 => 'shipped',
            6 => 'cancelled',
            7 => 'declined',
            8 => 'refunded',
            9 => 'disputed',
            10 => 'partially refunded'
        ];

        foreach ($orderStatusNames as $orderStatusName) {
            $orderStatus = new OrderStatus();
            $orderStatus->setName($orderStatusName);
            $manager->persist($orderStatus);
        }
        
        $contactTypeNames = [
            1 => 'email',
            2 => 'phone',
            3 => 'telegram'
        ];

        foreach ($contactTypeNames as $contactTypeName) {
            $contactType = new ContactType();
            $contactType->setName($contactTypeName);
            $manager->persist($contactType);
        }

        $manager->flush();
    }
}

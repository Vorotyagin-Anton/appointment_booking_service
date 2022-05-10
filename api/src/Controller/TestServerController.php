<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\WorkerAvailableTimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TestServerController extends AbstractController
{
    #[Route('/api/test/server', name: 'app_test_server')]
    public function index(
        UserRepository $userRepository,
        WorkerAvailableTimeRepository $workerAvailableTimeRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager
    ): Response
    {
        $user = $userRepository->findOneBy(['isWorker' => true]);
        $workerAvailableTime = $workerAvailableTimeRepository->findOneBy(['worker' => $user]);

        $user->removeWorkerAvailableTime($workerAvailableTime);

        $workerAvailableTime->setExactTimeInMinutes(777);
        $user->addWorkerAvailableTime($workerAvailableTime);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($serializer->serialize($user, 'json', ['groups' => [
            'userShort',
            'user_services',
            'serviceShort',
            'user_workerAvailableTimes',
            'workerAvailableTimeShort'
        ]]));
    }
}

<?php

namespace App\Controller;

use App\Entity\User\User;
use App\Entity\WorkerService;
use App\Repository\ServiceRepository;
use App\Repository\WorkerRepository;
use App\Repository\WorkerServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class WorkerServiceController extends AbstractController
{
    #[Route(path: '/api/worker-services', name: 'app_worker_service_post', methods: ['POST'])]
    public function addWorkerService(
        EntityManagerInterface $entityManager,
        WorkerRepository $workerRepository,
        ServiceRepository $serviceRepository,
        Request $request,
        #[CurrentUser] ?User $currentUser
    ): Response
    {
        $data = $request->toArray();

        $worker = $workerRepository->find($data['worker'] ?? null);
        if (!$worker) {
            return new Response('can not find worker', Response::HTTP_NOT_FOUND);
        }
        if ($worker !== $currentUser) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $service = $serviceRepository->find($data['service'] ?? null);
        if (!$service) {
            return new Response('can not find service', Response::HTTP_NOT_FOUND);
        }

        $workerService = new WorkerService();
        $workerService->setWorker($worker);
        $workerService->setService($service);
        $workerService->setDescription($data['description'] ?? null);
        $workerService->setDuration($data['duration'] ?? null);
        $workerService->setPrice($data['price'] ?? null);

        $entityManager->persist($workerService);
        $entityManager->flush();

        return $this->json($workerService, Response::HTTP_CREATED, [], ['groups' => [
            'workerServiceShort',
            'workerService_service',
            'serviceShort'
        ]]);
    }

    #[Route(
        path: '/api/worker-services/{id}',
        name: 'app_worker_service_delete',
        requirements: ['id' => '\d+'],
        methods: ['DELETE']
    )]
    public function deleteWorkerService(
        int $id,
        WorkerServiceRepository $workerServiceRepository,
        #[CurrentUser] ?User $currentUser
    ): Response
    {
        $workerService = $workerServiceRepository->find($id);
        if (!isset($workerService)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $worker = $workerService->getWorker();
        if ($worker !== $currentUser) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $workerServiceRepository->remove($workerService);

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    #[Route(
        path: '/api/worker-services/{id}',
        name: 'app_worker_service_patch',
        requirements: ['id' => '\d+'],
        methods: ['PATCH']
    )]
    public function updateWorkerService(
        int $id,
        EntityManagerInterface $entityManager,
        WorkerServiceRepository $workerServiceRepository,
        Request $request,
        #[CurrentUser] ?User $currentUser
    ): Response
    {
        $workerService = $workerServiceRepository->find($id);
        if (!isset($workerService)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $worker = $workerService->getWorker();
        if ($worker !== $currentUser) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $data = $request->toArray();
        $workerService->setDescription($data['description'] ?? null);
        $workerService->setDuration($data['duration'] ?? null);
        $workerService->setPrice($data['price'] ?? null);

        $entityManager->persist($workerService);
        $entityManager->flush();

        return $this->json($workerService, Response::HTTP_CREATED, [], ['groups' => [
            'workerServiceShort',
            'workerService_service',
            'serviceShort'
        ]]);
    }
}

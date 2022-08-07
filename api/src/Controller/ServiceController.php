<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route(path: '/api/services', name: 'app_services_get', methods: ['GET'])]
    public function getAllServices(
        ServiceRepository $serviceRepository
    ): Response
    {
        $services = $serviceRepository->findAll();
        return $this->json($services, Response::HTTP_OK, [], ['groups' => [
            'serviceShort'
        ]]);
    }

    #[Route(
        path: '/api/services/{id}',
        name: 'app_service_get',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
    public function getOneServiceCategories(
        int $id,
        ServiceRepository $serviceRepository
    ): Response
    {
        $service = $serviceRepository->find($id);
        if (!isset($service)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return $this->json($service, Response::HTTP_OK, [], ['groups' => [
            'serviceShort'
        ]]);
    }
}

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
}

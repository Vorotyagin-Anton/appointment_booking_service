<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ServiceController extends AbstractController
{
    #[Route(path: '/api/services', name: 'app_services_get', methods: ['GET'])]
    public function getAllServices(
        ServiceRepository $serviceRepository,
        SerializerInterface $serializer
    ): Response
    {
        $services = $serviceRepository->findAll();
        return $this->json($serializer->serialize($services, 'json', ['groups' => [
            'serviceShort'
        ]]));
    }
}

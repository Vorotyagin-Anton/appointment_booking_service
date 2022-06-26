<?php

namespace App\Controller;

use App\Repository\ServiceCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ServiceCategoryController extends AbstractController
{
    #[Route(path: '/api/service-categories', name: 'app_service_categories_get', methods: ['GET'])]
    public function getAllServiceCategories(
        ServiceCategoryRepository $serviceCategoryRepository
    ): Response
    {
        $serviceCategories = $serviceCategoryRepository->findAll();
        return $this->json($serviceCategories, Response::HTTP_OK, [], ['groups' => [
            'serviceCategoryShort'
        ]]);
    }
}

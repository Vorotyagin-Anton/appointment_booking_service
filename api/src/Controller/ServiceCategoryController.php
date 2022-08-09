<?php

namespace App\Controller;

use App\Repository\ServiceCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceCategoryController extends AbstractController
{
    #[Route(path: '/api/service-categories', name: 'app_service_categories_get', methods: ['GET'])]
    public function getAllServiceCategories(
        ServiceCategoryRepository $serviceCategoryRepository
    ): Response
    {
        $serviceCategories = $serviceCategoryRepository->findAll();
        return $this->json($serviceCategories, Response::HTTP_OK, [], ['groups' => [
            'serviceCategoryShort',
            'serviceCategory_service',
            'serviceShort'
        ]]);
    }

    #[Route(
        path: '/api/service-categories/{id}',
        name: 'app_service_category_get',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
    public function getOneServiceCategories(
        int $id,
        ServiceCategoryRepository $serviceCategoryRepository
    ): Response
    {
        $serviceCategory = $serviceCategoryRepository->find($id);
        if (!isset($serviceCategory)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return $this->json($serviceCategory, Response::HTTP_OK, [], ['groups' => [
            'serviceCategoryShort',
            'serviceCategory_service',
            'serviceShort'
        ]]);
    }
}

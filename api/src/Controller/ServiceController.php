<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use App\Service\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route(path: '/api/services', name: 'app_services_get', methods: ['GET'])]
    public function getAllServices(
        ServiceRepository $serviceRepository,
        Paginator $paginator,
        RequestStack $requestStack,
    ): Response
    {
        $categories = $requestStack->getCurrentRequest()->get('categories');
        $order = $requestStack->getCurrentRequest()->get('order');
        $sort = $requestStack->getCurrentRequest()->get('sort');
        $searchByName = $requestStack->getCurrentRequest()->get('name');

        $result = $paginator->getPaginationResult($serviceRepository->getDQLQueryWithFilters(
            [
                'categories' => $categories,
                'order' => $order,
                'sort' => $sort,
                'searchByName' => $searchByName,
            ]
        ));

        if (empty($result['items'])) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return $this->json($result, Response::HTTP_OK, [], ['groups' => [
            'serviceShort'
        ]]);
    }

    #[Route(
        path: '/api/services/{id}',
        name: 'app_service_get',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
    public function getOneService(
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

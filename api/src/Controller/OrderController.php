<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class OrderController extends AbstractController
{
    #[Route(path: 'api/orders', name: 'app_orders', methods: ['GET'])]
    public function index(OrderRepository $orderRepository, SerializerInterface $serializer): Response
    {
        $orders = $orderRepository->findAll();
        return $this->json($serializer->serialize($orders, 'json', ['groups' => [
            'orderShort',
            'order_client',
            'order_worker',
            'userShort'
        ]]));
    }

    #[Route(path: 'api/orders', name: 'app_orders_post', methods: ['POST'])]
    public function saveOrder(
        Request $request
    ): Response
    {
        return new Response($request->getContent());
    }
}

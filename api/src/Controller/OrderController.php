<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class OrderController extends AbstractController
{
    #[Route('api/order', name: 'app_order')]
    public function index(OrderRepository $orderRepository, SerializerInterface $serializer): Response
    {
        $orders = $orderRepository->findAll();
        return $this->json($serializer->serialize($orders, 'json'));
    }
}
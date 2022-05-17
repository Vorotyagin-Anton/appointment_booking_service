<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\SerializerInterface;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'app_login', methods: ['POST'])]
    public function login(#[CurrentUser] ?User $user, SerializerInterface $serializer): Response
    {
        return $this->json($serializer->serialize(
            [
                'status' => 'success',
                'message' => 'login success',
                'data' => ['user' => $user]
            ],
            'json',
            ['groups' => [
                'userShort'
            ]]
        ));
    }
}

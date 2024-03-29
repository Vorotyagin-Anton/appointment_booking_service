<?php

namespace App\Controller;

use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'app_login', methods: ['POST'])]
    public function login(
        #[CurrentUser] User $user
    ): Response
    {
        return $this->json($user, Response::HTTP_OK, [], ['groups' => [
            'userShort',
            'user_addresses',
            'addressShort'
        ]]);
    }
}

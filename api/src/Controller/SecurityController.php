<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\SerializerInterface;

class SecurityController extends AbstractController
{
    #[Route('/api/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void
    {
    }

    #[Route('/api/check-auth', name: 'check_auth', methods: ['GET'])]
    public function checkAuth(#[CurrentUser] ?User $user, SerializerInterface $serializer): Response
    {
        if (null === $user) {
            return $this->json($serializer->serialize(
                [
                    'status' => 'error',
                    'message' => 'there is no authorized user',
                    'data' => []
                ],
                'json',
                ['groups' => [
                    'userShort'
                ]]
            ));
        }

        return $this->json($serializer->serialize(
            [
                'status' => 'success',
                'message' => 'there is an authorized user',
                'data' => ['user' => $user]
            ],
            'json',
            ['groups' => [
                'userShort'
            ]]
        ));
    }
}

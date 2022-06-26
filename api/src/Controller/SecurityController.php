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
    public function checkAuth(
        #[CurrentUser] ?User $user
    ): Response
    {
        if (!isset($user)) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        return $this->json($user, Response::HTTP_OK, [], ['groups' => [
            'userShort'
        ]]);
    }
}

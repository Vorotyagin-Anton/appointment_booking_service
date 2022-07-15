<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/api/users/clients', name: 'app_users_clients', methods: ['GET'])]
    public function getClientsOnlyByPages(
        UserRepository $userRepository,
        Paginator $paginator
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $result = $paginator->getPaginationResult($userRepository->getQueryBuilderBy(['isClient' => true]));
        return $this->json($result, Response::HTTP_OK, [], ['groups' => [
            'userShort',
        ]]);
    }
}

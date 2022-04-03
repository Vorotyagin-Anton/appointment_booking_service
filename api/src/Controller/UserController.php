<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    #[Route(path: '/api/users', name: 'app_users_get', methods: ['GET'])]
    public function getAllUsers(
        UserRepository $userRepository,
        SerializerInterface $serializer
    ): Response
    {
        $users = $userRepository->findAll();
        return $this->json($serializer->serialize($users, 'json'));
    }

    #[Route(path: '/api/users', name: 'app_users_post', methods: ['POST'])]
    public function addUser(
        UserRepository $userRepository,
        SerializerInterface $serializer,
        Request $request
    ): Response
    {
        $postData = $request->request->all();

        $user = new User(
            $postData['surname'],
            $postData['name'],
            $postData['middlename']
        );

        $user->setIsClient($postData['isClient'] ?? false);
        $user->setIsWorker($postData['isWorker'] ?? false);
        $user->setPathToPhoto($postData['pathToPhoto'] ?? '/public/uploads/photo/dummy.jpg');

        $userRepository->add($user);

        return $this->json($serializer->serialize(['result' => 'ok'], 'json'));
    }

    #[Route(path: '/api/users/{id}', name: 'app_users_delete', methods: ['DELETE'])]
    public function deleteUser(
        int $id,
        UserRepository $userRepository,
        SerializerInterface $serializer
    ): Response
    {
        $user = $userRepository->find($id);

        if (!isset($user)) {
            return $this->json($serializer->serialize(['result' => 'user not found'], 'json'));
        }

        $userRepository->remove($user);

        return $this->json($serializer->serialize(['result' => 'ok'], 'json'));
    }

    #[Route(path: '/api/users/{id}', name: 'app_users_patch', methods: ['PATCH'])]
    public function updateUser(
        int $id,
        UserRepository $userRepository,
        SerializerInterface $serializer,
        Request $request
    ): Response
    {
        $postData = $request->toArray();
        $user = $userRepository->find($id);

        if (!isset($user)) {
            return $this->json($serializer->serialize(['result' => 'user not found'], 'json'));
        }

        $user->setName($postData['name']);
        $user->setSurname($postData['surname']);
        $user->setMiddlename($postData['middlename']);

        $userRepository->add($user);

        return $this->json($serializer->serialize(['result' => 'ok'], 'json'));
    }

    #[Route('/api/users/workers', name: 'app_users_workers', methods: ['GET'])]
    public function getWorkersOnlyByPages(
        UserRepository $userRepository,
        SerializerInterface $serializer,
        Paginator $paginator
    ): Response
    {
        $result = $paginator->getPaginationResult($userRepository->getQueryBuilderBy(['isWorker' => true]));
        return $this->json($serializer->serialize($result, 'json'));
    }

    #[Route('/api/users/clients', name: 'app_users_clients', methods: ['GET'])]
    public function getClientsOnlyByPages(
        UserRepository $userRepository,
        SerializerInterface $serializer,
        Paginator $paginator
    ): Response
    {
        $result = $paginator->getPaginationResult($userRepository->getQueryBuilderBy(['isClient' => true]));
        return $this->json($serializer->serialize($result, 'json'));
    }
}

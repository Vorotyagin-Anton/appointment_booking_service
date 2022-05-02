<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use App\Service\Paginator;
use Doctrine\ORM\EntityManagerInterface;
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
        return $this->json($serializer->serialize($users, 'json', ['groups' => [
            'userShort'
        ]]));
    }

    #[Route(path: '/api/users/{id}', name: 'app_user_get', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneUser(
        int $id,
        UserRepository $userRepository,
        SerializerInterface $serializer
    ): Response
    {
        $user = $userRepository->find($id);
        return $this->json($serializer->serialize($user, 'json', ['groups' => [
            'userShort'
        ]]));
    }

    #[Route(path: '/api/users', name: 'app_users_post', methods: ['POST'])]
    public function addUser(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        Request $request
    ): Response
    {
        $user = new User();

        $form = $this->createForm(UserFormType::class, $user, ['csrf_protection' => false]);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json($serializer->serialize($user, 'json', ['groups' => [
                'userShort'
            ]]));
        }

        return $this->json($serializer->serialize($form, 'json'));
    }

    #[Route(path: '/api/users/{id}', name: 'app_users_delete', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function deleteUser(
        int $id,
        UserRepository $userRepository,
        SerializerInterface $serializer
    ): Response
    {
        $user = $userRepository->find($id);

        if (!isset($user)) {
            return $this->json($serializer->serialize(['error' => 'user not found'], 'json'));
        }

        $userRepository->remove($user);

        return $this->json($serializer->serialize(['result' => 'ok'], 'json'));
    }

    #[Route(path: '/api/users/{id}', name: 'app_users_patch', requirements: ['id' => '\d+'], methods: ['PATCH'])]
    public function updateUser(
        int $id,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        SerializerInterface $serializer,
        Request $request
    ): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            return $this->json($serializer->serialize(['error' => 'user not found'], 'json'));
        }

        $form = $this->createForm(UserFormType::class, $user, ['csrf_protection' => false]);
        $form->submit($request->toArray(), false);

        if ($form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json($serializer->serialize($user, 'json', ['groups' => [
                'userShort'
            ]]));
        }

        return $this->json($serializer->serialize($form, 'json'));
    }

    #[Route('/api/users/workers', name: 'app_users_workers', methods: ['GET'])]
    public function getWorkersOnlyByPages(
        UserRepository $userRepository,
        SerializerInterface $serializer,
        Paginator $paginator
    ): Response
    {
        $result = $paginator->getPaginationResult($userRepository->getQueryBuilderBy(['isWorker' => true]));
        return $this->json($serializer->serialize($result, 'json', ['groups' => [
            'userShort',
            'user_services',
            'serviceShort'
        ]]));
    }

    #[Route('/api/users/clients', name: 'app_users_clients', methods: ['GET'])]
    public function getClientsOnlyByPages(
        UserRepository $userRepository,
        SerializerInterface $serializer,
        Paginator $paginator
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $result = $paginator->getPaginationResult($userRepository->getQueryBuilderBy(['isClient' => true]));
        return $this->json($serializer->serialize($result, 'json', ['groups' => [
            'userShort',
        ]]));
    }
}

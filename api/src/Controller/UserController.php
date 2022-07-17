<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class UserController extends AbstractController
{
    #[Route(path: '/api/users', name: 'app_users_get', methods: ['GET'])]
    public function getAllUsers(
        UserRepository $userRepository
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $users = $userRepository->findAll();
        return $this->json($users, Response::HTTP_OK, [], ['groups' => [
            'userShort'
        ]]);
    }

    #[Route(path: '/api/users/{id}', name: 'app_user_get', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneUser(
        int $id,
        UserRepository $userRepository
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $userRepository->find($id);
        if (!isset($user)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return $this->json($user, Response::HTTP_OK, [], ['groups' => [
            'userShort'
        ]]);
    }

    #[Route(path: '/api/users', name: 'app_users_post', methods: ['POST'])]
    public function addUser(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = new User();

        $form = $this->createForm(UserFormType::class, $user, ['csrf_protection' => false]);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            if (is_null($user->getIsWorker())) {
                $user->setIsWorker(false);
            }

            if (is_null($user->getIsClient())) {
                $user->setIsClient(false);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json($user, Response::HTTP_CREATED, [], ['groups' => [
                'userShort'
            ]]);
        }

        return $this->json($form, Response::HTTP_BAD_REQUEST);
    }

    #[Route(path: '/api/users/{id}', name: 'app_users_delete', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function deleteUser(
        int $id,
        UserRepository $userRepository
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $userRepository->find($id);

        if (!isset($user)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $userRepository->remove($user);

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    #[Route(path: '/api/users/{id}', name: 'app_users_patch', requirements: ['id' => '\d+'], methods: ['PATCH'])]
    public function updateUser(
        int $id,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        Request $request,
        #[CurrentUser] ?User $currentUser
    ): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        if ($user !== $currentUser) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $data = $request->toArray();
        $userAddress = $user->getAddresses()->toArray()[0] ?? null;
        if (!$userAddress) {
            $userAddress = new Address();
            $user->addAddress($userAddress);
        }
        $userAddress->setState($data['state'] ?? null);
        unset($data['state']);
        $userAddress->setCity($data['city'] ?? null);
        unset($data['city']);
        $userAddress->setStreet($data['street'] ?? null);
        unset($data['street']);
        $userAddress->setHome($data['home'] ?? null);
        unset($data['home']);
        $userAddress->setCode(intval($data['code'] ?? null));
        unset($data['code']);

        $form = $this->createForm(UserFormType::class, $user, ['csrf_protection' => false]);
        $form->submit($data, false);

        if ($form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json($user, Response::HTTP_CREATED, [], ['groups' => [
                'userShort'
            ]]);
        }

        return $this->json($form, Response::HTTP_BAD_REQUEST);
    }

    #[Route('/api/users/change-password', name: 'app_users_change_password', methods: ['PATCH'])]
    public function changePassword(
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
        Request $request,
        #[CurrentUser] ?User $currentUser
    ): Response
    {
        $data = json_decode($request->getContent());
        $userId = $data->userId;
        $userNewPassword = $data->newPassword;
        $userOldPassword = $data->oldPassword;

        $user = $em->getRepository(User::class)->findOneBy(['id' => $userId]);
        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        if ($user !== $currentUser) {
            return new Response('', Response::HTTP_FORBIDDEN);
        }

        if (!$passwordHasher->isPasswordValid($user, $userOldPassword)) {
            return $this->json(['error' => 'Invalid credentials.'], Response::HTTP_UNAUTHORIZED);
        }

        $user->setPassword(
            $passwordHasher->hashPassword(
                $user,
                $userNewPassword
            )
        );

        $em->persist($user);
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}

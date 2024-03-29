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

    #[Route(path: '/api/users/{id}/change-photo', name: 'app_users_change-photo', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function updateUserPhoto(
        int $id,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        Request $request,
        #[CurrentUser] ?User $currentUser
    ): Response
    {
        if (!isset($currentUser)) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        $user = $userRepository->find($id);

        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        if ($user !== $currentUser) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $uploadedPhoto = $request->files->get('userPhoto');

        $destination = $this->getParameter('app.uploads_dir').'/photo/users/'.$user->getId();
        $originalFilename = pathinfo($uploadedPhoto->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedPhoto->guessExtension();

        $uploadedPhoto->move($this->getParameter('kernel.project_dir')."/public/$destination", $newFilename);

        $user->setPathToPhoto("$destination/$newFilename");
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user, Response::HTTP_CREATED, [], ['groups' => [
            'userShort'
        ]]);
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
        if (!isset($currentUser)) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        $user = $userRepository->find($id);

        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        if ($user !== $currentUser) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        // TODO smells bad
        $postData = $request->toArray();
        $userAddress = $user->getAddresses()->toArray()[0] ?? null;
        if (!$userAddress) {
            $userAddress = new Address();
            $user->addAddress($userAddress);
        }
        $userAddress->setState($postData['state'] ?? null);
        unset($postData['state']);
        $userAddress->setCity($postData['city'] ?? null);
        unset($postData['city']);
        $userAddress->setStreet($postData['street'] ?? null);
        unset($postData['street']);
        $userAddress->setHome($postData['home'] ?? null);
        unset($postData['home']);
        $userAddress->setCode(intval($postData['code'] ?? null));
        unset($postData['code']);

        $form = $this->createForm(UserFormType::class, $user, ['csrf_protection' => false]);
        $form->submit($postData, false);

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
        if (!isset($currentUser)) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

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

<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use App\Entity\WorkerAvailableTime;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use App\Repository\WorkerAvailableTimeRepository;
use App\Service\CustomDataValidator;
use App\Service\Paginator;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserController extends AbstractController
{
    #[Route(path: '/api/users', name: 'app_users_get', methods: ['GET'])]
    public function getAllUsers(
        UserRepository $userRepository
    ): Response
    {
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
        $user = $userRepository->find($id);

        if (!isset($user)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        try {
            $userRepository->remove($user);
        } catch (\Exception $exception) {
            // TODO add an error message to a log
            return $this->json(['error' => 'server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    #[Route(path: '/api/users/{id}', name: 'app_users_patch', requirements: ['id' => '\d+'], methods: ['PATCH'])]
    public function updateUser(
        int $id,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        Request $request
    ): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
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

            return new Response('', Response::HTTP_NO_CONTENT);
        }

        return $this->json($form, Response::HTTP_BAD_REQUEST);
    }

    #[Route('/api/users/workers', name: 'app_users_workers', methods: ['GET'])]
    public function getWorkersOnlyByPages(
        UserRepository $userRepository,
        Paginator $paginator,
        RequestStack $requestStack,
        CustomDataValidator $customDataValidator
    ): Response
    {
        $categories = $requestStack->getCurrentRequest()->get('categories');
        $services = $requestStack->getCurrentRequest()->get('services');
        $order = $requestStack->getCurrentRequest()->get('order');
        $sort = $requestStack->getCurrentRequest()->get('sort');
        $searchByName = $requestStack->getCurrentRequest()->get('name');
        $requiredDates = $requestStack->getCurrentRequest()->get('days') ?? [];

        $datesForFilter = [
            'singleDates' => [],
            'dateRanges' => []
        ];
        foreach ($requiredDates as $date) {
            if ($customDataValidator->isDateTimeValid($date, 'Y-m-d')) {
                $datesForFilter['singleDates'][] = $date;
                continue;
            }

            $dateRange = \json_decode($date, true);
            if (
                $customDataValidator->isDateTimeValid($dateRange['from'], 'Y-m-d') &&
                $customDataValidator->isDateTimeValid($dateRange['to'], 'Y-m-d')
            ) {
                $datesForFilter['dateRanges'][] = [
                    'from' => $dateRange['from'],
                    'to' => $dateRange['to']
                ];
            }
        }

        $result = $paginator->getPaginationResult($userRepository->getQueryBuilderBy(
            ['isWorker' => true],
            [
                'categories' => $categories,
                'services' => $services,
                'order' => $order,
                'sort' => $sort,
                'searchByName' => $searchByName,
                'requiredDates' => $datesForFilter
            ]
        ));

        if (empty($result['items'])) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return $this->json($result, Response::HTTP_OK, [], ['groups' => [
            'userShort',
            'user_services',
            'serviceShort',
            'user_rating',
            'ratingShort'
        ]]);
    }

    #[Route(path: '/api/users/workers/{id}', name: 'app_users_worker_get', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneWorker(
        int $id,
        UserRepository $userRepository,
        WorkerAvailableTimeRepository $workerAvailableTimeRepository
    ): Response
    {
        $user = $userRepository->findOneBy(['id' => $id, 'isWorker' => true]);
        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $workerTimeCollection = $workerAvailableTimeRepository->findBy(['worker' => $user, 'isTimeFree' => true]);
        $serializerManual = new Serializer([
            new DateTimeNormalizer(),
            new ObjectNormalizer(new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader())))
        ]);
        try {
            $workerTimeArray = $serializerManual->normalize($workerTimeCollection, null, [
                'groups' => ['workerAvailableTimeShort'],
                DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'
            ]);
        } catch (\Exception|ExceptionInterface $exception) {
            // TODO add an error message to a log
            return $this->json(['error' => 'server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $workerTimeConverted = [];
        foreach ($workerTimeArray as $workerTime) {
            $workerTimeConverted[$workerTime['exactDate']][] = [
                'id' => $workerTime['id'],
                'value' => $workerTime['exactTimeInMinutes'],
                'isTimeFree' => $workerTime['isTimeFree']
            ];
        }

        $workerTimeResponse = [];
        foreach ($workerTimeConverted as $date => $timeArray) {
            $workerTimeResponse[] = [
                'date' => $date,
                'timeArray' => $timeArray
            ];
        }

        return $this->json(
            [
                'worker' => $user,
                'workerFreeTime' => $workerTimeResponse
            ],
            Response::HTTP_OK,
            [],
            [
                'groups' => [
                    'userShort',
                    'user_services',
                    'serviceShort',
                    'service_category',
                    'serviceCategoryShort',
                    'user_rating',
                    'ratingShort',
                    'user_career',
                    'careerShort',
                    'user_gettedReviews',
                    'reviewShort',
                    'review_reviewer'
                ],
                DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'
            ]
        );
    }

    #[Route(path: '/api/users/workers/{id}/worker-available-time', name: 'app_users_worker_change_available_time', requirements: ['id' => '\d+'], methods: ['PATCH'])]
    public function changeWorkerAvailableTime(
        int $id,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        Request $request
    ): Response
    {
        $user = $userRepository->findOneBy(['id' => $id, 'isWorker' => true]);
        $data = $request->toArray();

        foreach ($data['delete'] as $timeForDeleteId) {
            $timeForDelete = $entityManager->getRepository(WorkerAvailableTime::class)->findOneBy(['id' => $timeForDeleteId]);
            $user->removeWorkerAvailableTime($timeForDelete);
        }
        $entityManager->persist($user);
        $entityManager->flush();

        foreach ($data['add'] as $addedDataItem) {
            foreach ($addedDataItem['slots'] as $timeInMinutes) {
                $time = new WorkerAvailableTime();
                $time->setWorker($user);
                $time->setExactDate(\DateTime::createFromFormat('Y/m/d', $addedDataItem['date']));
                $time->setExactTimeInMinutes((int)$timeInMinutes);
                $time->setIsTimeFree(true);
                $user->addWorkerAvailableTime($time);
            }
        }
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

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

<?php

namespace App\Controller;

use App\Entity\User\User;
use App\Entity\WorkerAvailableTime;
use App\Repository\UserRepository;
use App\Repository\WorkerAvailableTimeRepository;
use App\Repository\WorkerRepository;
use App\Service\CustomDataValidator;
use App\Service\Paginator;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class WorkerController extends AbstractController
{
    #[Route('/api/users/workers', name: 'app_users_workers', methods: ['GET'])]
    public function getWorkersOnlyByPages(
        WorkerRepository    $workerRepository,
        Paginator           $paginator,
        RequestStack        $requestStack,
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

        $result = $paginator->getPaginationResult($workerRepository->getDQLQueryWithFilters(
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
            'workerShort',
            'worker_services',
            'workerServiceShort',
            'workerService_service',
            'serviceShort',
            'worker_rating',
            'ratingShort'
        ]]);
    }

    #[Route(
        path: '/api/users/workers/{id}',
        name: 'app_users_worker_get',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
    public function getOneWorker(
        int $id,
        UserRepository $userRepository,
        WorkerAvailableTimeRepository $workerAvailableTimeRepository,
        LoggerInterface $telegramDebugLogger
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
            $workerTimeArray = [];
            $telegramDebugLogger->error($exception->getMessage(), $exception->getTrace());
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
                    'workerShort',
                    'worker_services',
                    'workerServiceShort',
                    'workerService_service',
                    'serviceShort',
                    'service_category',
                    'serviceCategoryShort',
                    'worker_rating',
                    'ratingShort',
                    'worker_career',
                    'careerShort',
                    'worker_reviews',
                    'reviewShort',
                    'review_reviewer'
                ],
                DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'
            ]
        );
    }

    #[Route(
        path: '/api/users/workers/{id}/worker-available-time',
        name: 'app_users_worker_change_available_time',
        requirements: ['id' => '\d+'],
        methods: ['PATCH']
    )]
    public function changeWorkerAvailableTime(
        int $id,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        Request $request,
        #[CurrentUser] ?User $currentUser
    ): Response
    {
        $user = $userRepository->findOneBy(['id' => $id, 'isWorker' => true]);

        if (!$user) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        if ($user !== $currentUser) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $data = $request->toArray();

        foreach ($data['delete'] as $timeForDeleteId) {
            $timeForDelete = $entityManager
                ->getRepository(WorkerAvailableTime::class)
                ->findOneBy(['id' => $timeForDeleteId]);
            $user->removeAvailableTime($timeForDelete);
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
                $user->addAvailableTime($time);
            }
        }
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user, Response::HTTP_CREATED, [], ['groups' => [
            'userShort'
        ]]);
    }
}

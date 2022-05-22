<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use App\Repository\WorkerAvailableTimeRepository;
use App\Service\Paginator;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
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
        Paginator $paginator,
        RequestStack $requestStack
    ): Response
    {
        $categories = $requestStack->getCurrentRequest()->get('categories');
        $services = $requestStack->getCurrentRequest()->get('services');
        $order = $requestStack->getCurrentRequest()->get('order');
        $sort = $requestStack->getCurrentRequest()->get('sort');
        $searchByName = $requestStack->getCurrentRequest()->get('name');

        $result = $paginator->getPaginationResult($userRepository->getQueryBuilderBy(
            ['isWorker' => true],
            ['categories' => $categories, 'services' => $services, 'order' => $order, 'sort' => $sort, 'searchByName' => $searchByName]
        ));
        return $this->json($serializer->serialize($result, 'json', ['groups' => [
            'userShort',
            'user_services',
            'serviceShort'
        ]]));
    }

    /**
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    #[Route(path: '/api/users/workers/{id}', name: 'app_users_worker_get', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getOneWorker(
        int $id,
        UserRepository $userRepository,
        SerializerInterface $serializer,
        WorkerAvailableTimeRepository $workerAvailableTimeRepository
    ): Response
    {
        $user = $userRepository->findOneBy(['id' => $id, 'isWorker' => true]);
        // TODO: remove default user response after tests
        if (!$user) {
            $user = $userRepository->findOneBy(['isWorker' => true]);
        }

        $workerTimeCollection = $workerAvailableTimeRepository->findBy(['worker' => $user, 'isTimeFree' => true]);
        $serializerManual = new Serializer([
            new DateTimeNormalizer(),
            new ObjectNormalizer(new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader())))
        ]);
        $workerTimeArray = $serializerManual->normalize($workerTimeCollection, null, [
            'groups' => ['workerAvailableTimeShort'],
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'
        ]);

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

        return $this->json([
            'worker' => $serializer->serialize($user, 'json', [
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
            ]),
            'workerFreeTime' => json_encode($workerTimeResponse)
        ]);
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

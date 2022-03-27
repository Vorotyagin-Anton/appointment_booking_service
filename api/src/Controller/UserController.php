<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    #[Route('/api/user', name: 'app_user')]
    public function getAllUsers(UserRepository $userRepository, SerializerInterface $serializer): Response
    {
        $users = $userRepository->findAll();
        return $this->json($serializer->serialize($users, 'json'));
    }

    #[Route('/api/workers', name: 'app_masters')]
    public function getMastersOnlyByPages(
        UserRepository $userRepository,
        SerializerInterface $serializer,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $itemsPerPage = $request->query->getInt('itemsPerPage', 3);
        $pageNumber = $request->query->getInt('pageNumber', 1);

        $pagination = $paginator->paginate(
            $userRepository->getWorkersOnlyQueryBuilder(),
            $pageNumber,
            $itemsPerPage
        );

        $totalItems = $pagination->getTotalItemCount();
        $totalPages = ceil($totalItems/$itemsPerPage);

        $result = [
            'items' => $pagination,
            'currentPageNumber' => $pageNumber,
            'itemsPerPage' => $itemsPerPage,
            'totalItems' => $totalItems,
            'totalPages' => $totalPages
        ];


        return $this->json($serializer->serialize($result, 'json'));
    }
}

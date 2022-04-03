<?php

namespace App\Service;

use Doctrine\ORM\Query;
use JetBrains\PhpStorm\ArrayShape;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Paginator
{
    private PaginatorInterface $paginator;
    private RequestStack $requestStack;

    public function __construct(PaginatorInterface $paginator, RequestStack $requestStack)
    {
        $this->paginator = $paginator;
        $this->requestStack = $requestStack;
    }

    #[ArrayShape([
        'items' => "\Knp\Component\Pager\Pagination\PaginationInterface",
        'currentPage' => "int",
        'offset' => "int",
        'totalItems' => "int",
        'totalPages' => "int"
    ])]
    public function getPaginationResult(Query $query): array
    {
        $offset = $this->requestStack->getCurrentRequest()->query->getInt('offset', 3);
        $page = $this->requestStack->getCurrentRequest()->query->getInt('page', 1);

        $pagination = $this->paginator->paginate($query, $page, $offset);

        $totalItems = $pagination->getTotalItemCount();
        $totalPages = ceil($totalItems/$offset);

        return [
            'items' => $pagination,
            'currentPage' => $page,
            'offset' => $offset,
            'totalItems' => $totalItems,
            'totalPages' => $totalPages
        ];
    }
}
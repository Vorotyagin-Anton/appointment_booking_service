<?php

namespace App\Repository;

use App\Entity\WorkerService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkerService|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkerService|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkerService[]    findAll()
 * @method WorkerService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkerServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkerService::class);
    }

    public function add(WorkerService $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(WorkerService $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}

<?php

namespace App\Repository;

use App\Entity\WorkerAvailableTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkerAvailableTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkerAvailableTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkerAvailableTime[]    findAll()
 * @method WorkerAvailableTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkerAvailableTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkerAvailableTime::class);
    }

    public function add(WorkerAvailableTime $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(WorkerAvailableTime $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}

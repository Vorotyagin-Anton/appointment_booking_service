<?php

namespace App\Repository;

use App\Entity\Career;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Career|null find($id, $lockMode = null, $lockVersion = null)
 * @method Career|null findOneBy(array $criteria, array $orderBy = null)
 * @method Career[]    findAll()
 * @method Career[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CareerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Career::class);
    }

    public function add(Career $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(Career $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}

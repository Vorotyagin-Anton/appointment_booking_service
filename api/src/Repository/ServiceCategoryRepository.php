<?php

namespace App\Repository;

use App\Entity\ServiceCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceCategory[]    findAll()
 * @method ServiceCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceCategory::class);
    }

    public function add(ServiceCategory $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(ServiceCategory $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}

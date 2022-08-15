<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

/**
 * @method Service|null find($id, $lockMode = null, $lockVersion = null)
 * @method Service|null findOneBy(array $criteria, array $orderBy = null)
 * @method Service[]    findAll()
 * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }

    public function add(Service $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(Service $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getDQLQueryWithFilters(array $filters = []): Query
    {
        $builder = $this->createQueryBuilder('s');
        $builder->orderBy('s.id', 'ASC');

        if (isset($filters['categories'])) {
            $builder
                ->join('s.category', 'categories')
                ->andWhere($builder->expr()->in('categories.id', $filters['categories']));
        }

        if (isset($filters['sort']) && isset($filters['order'])) {
            $propertyInfo = new PropertyInfoExtractor([new ReflectionExtractor()], [new ReflectionExtractor()]);
            $types = $propertyInfo->getTypes(Service::class, $filters['sort']);
            if (isset($types[0]) && in_array($types[0]->getBuiltinType(), ['int', 'string'])){
                $builder->orderBy('s.' . strtolower($filters['sort']), $filters['order']);
            }
        }

        if (isset($filters['searchByName'])) {
            $builder
                ->andWhere($builder->expr()->orX(
                    $builder->expr()->like('s.name', ':name')
                ))
                ->setParameter('name', '%' . $filters['searchByName'] . '%');
        }

        return $builder->getQuery();
    }
}

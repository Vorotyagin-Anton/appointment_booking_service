<?php

namespace App\Repository;

use App\Entity\User\Worker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

/**
 * @method Worker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Worker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Worker[]    findAll()
 * @method Worker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Worker::class);
    }

    public function add(Worker $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(Worker $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getDQLQueryBy(array $criteria): Query
    {
        $criteriaName = array_key_first($criteria);
        $criteriaValue = $criteria[$criteriaName];

        $builder = $this->createQueryBuilder('u');
        $builder
            ->orderBy('u.id', 'ASC')
            ->andWhere($builder->expr()->eq("u.$criteriaName", ":$criteriaName"))
            ->setParameter($criteriaName, $criteriaValue);

        return $builder->getQuery();
    }

    public function getDQLQueryWithFilters(array $filters = []): Query
    {
        $builder = $this->createQueryBuilder('u');
        $builder->orderBy('u.id', 'ASC');

        if (isset($filters['services'])) {
            $builder->join('u.services', 'serv');
            $builder->andWhere($builder->expr()->in('serv.id', $filters['services']));
        }

        if (isset($filters['categories'])) {
            $builder
                ->join('u.services', 'servcat')
                ->join('servcat.category', 'cat');
            $builder->andWhere($builder->expr()->in('cat.id', $filters['categories']));
        }

        if (isset($filters['sort']) && isset($filters['order'])) {
            if (strtolower($filters['sort']) === 'rating') {
                $builder
                    ->join('u.rating', 'ur')
                    ->orderBy('ur.score', $filters['order']);
            }

            if (strtolower($filters['sort']) === 'popularity') {
                $builder
                    ->join('u.rating', 'ur')
                    ->orderBy('ur.voices', $filters['order']);
            }

            $propertyInfo = new PropertyInfoExtractor([new ReflectionExtractor()], [new ReflectionExtractor()]);
            $types = $propertyInfo->getTypes(Worker::class, $filters['sort']);
            if (isset($types[0]) && in_array($types[0]->getBuiltinType(), ['int', 'string'])){
                $builder->orderBy('u.' . strtolower($filters['sort']), $filters['order']);
            }
        }

        if (isset($filters['searchByName'])) {
            $builder
                ->andWhere($builder->expr()->orX(
                    $builder->expr()->like('u.name', ':name'),
                    $builder->expr()->like('u.surname', ':name')
                ))
                ->setParameter('name', '%' . $filters['searchByName'] . '%');
        }

        if (isset($filters['requiredDates'])) {
            $builder
                ->join('u.availableTimes', 'wat')
                ->andWhere($builder->expr()->eq("wat.isTimeFree", ":isTimeFree"))
                ->setParameter('isTimeFree', true);

            $requiredDateExpressions = [];

            foreach ($filters['requiredDates']['dateRanges'] as $k => $dateRange) {
                $requiredDateExpressions[] = $builder->expr()->between('wat.exactDate', ":dateFrom{$k}", ":dateTo{$k}");
                $builder
                    ->setParameter(":dateFrom{$k}", $dateRange['from'])
                    ->setParameter(":dateTo{$k}", $dateRange['to']);
            }

            if (!empty($filters['requiredDates']['singleDates'])) {
                $requiredDateExpressions[] = $builder->expr()->in('wat.exactDate', ':exactDates');
                $builder->setParameter("exactDates", $filters['requiredDates']['singleDates']);
            }

            $builder
                ->andWhere($builder->expr()->orX(
                    ...$requiredDateExpressions
                ));
        }

        return $builder->getQuery();
    }
}

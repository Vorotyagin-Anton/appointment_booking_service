<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(User $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(User $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getQueryBuilderBy(array $criteria, array $filters = [])
    {
        $criteriaName = array_key_first($criteria);
        $criteriaValue = $criteria[$criteriaName];

        $builder = $this->createQueryBuilder('u');
        $builder
            ->orderBy('u.id', 'ASC')
            ->andWhere($builder->expr()->eq("u.$criteriaName", ":$criteriaName"))
            ->setParameter($criteriaName, $criteriaValue);

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
            $types = $propertyInfo->getTypes(User::class, $filters['sort']);
            if (isset($types[0]) && in_array($types[0]->getBuiltinType(), ['int', 'string'])){
                $builder->orderBy('u.' . strtolower($filters['sort']), $filters['order']);
            }
        }

        if (isset($filters['searchByName'])) {
            $builder
                ->andWhere($builder->expr()->like('u.name', ':name'))
                ->orWhere($builder->expr()->like('u.surname', ':name'))
                ->setParameter('name', '%' . $filters['searchByName'] . '%');
        }

        return $builder->getQuery();
    }
}

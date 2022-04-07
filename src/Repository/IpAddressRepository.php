<?php

namespace App\Repository;

use App\Entity\IpAddress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IpAddress|null find($id, $lockMode = null, $lockVersion = null)
 * @method IpAddress|null findOneBy(array $criteria, array $orderBy = null)
 * @method IpAddress[]    findAll()
 * @method IpAddress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IpAddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IpAddress::class);
    }

    /**
     * @param IpAddress $entity
     * @param bool $flush
     */
    public function add(IpAddress $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param IpAddress $entity
     * @param bool $flush
     */
    public function update(IpAddress $entity, bool $flush = true): void
    {
        $this->_em->flush();
    }

    /**
     * @return Query
     */
    public function getTableRawQuery()
    {
        $query = $this->createQueryBuilder('i');

        // Return query
        return $query->getQuery();
    }

    // /**
    //  * @return IpAddress[] Returns an array of IpAddress objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IpAddress
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

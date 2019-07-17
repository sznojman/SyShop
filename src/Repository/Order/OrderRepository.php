<?php

namespace App\Repository\Order;

use App\Entity\Order\Order;
use App\Entity\Order\OrderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Order::class);
    }
	public function findOneById($id): ?OrderInterface
	{
		return $this->createQueryBuilder('o')
		            ->andWhere('o.id = :id')
		            ->setParameter('id', $id)
		            ->getQuery()
		            ->getOneOrNullResult()
			;
	}
	public function findOneByHash($hash): ?OrderInterface
	{
		return $this->createQueryBuilder('o')
		            ->andWhere('o.hash = :hash')
		            ->setParameter('hash', $hash)
		            ->getQuery()
		            ->getOneOrNullResult()
			;
	}
    // /**
    //  * @return Order[] Returns an array of Order objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

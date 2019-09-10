<?php

namespace App\Repository\Cart;

use App\Entity\Cart\Cart;
use App\Entity\Cart\CartInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cart::class);
    }
	public function findOneById($id): ?CartInterface
	{
		return $this->createQueryBuilder('o')
		            ->andWhere('o.id = :id')
		            ->setParameter('id', $id)
		            ->getQuery()
		            ->getOneOrNullResult()
			;
	}
	public function findOneByHash($hash): ?CartInterface
	{
		return $this->createQueryBuilder('o')
		            ->andWhere('o.hash = :hash')
		            ->setParameter('hash', $hash)
		            ->getQuery()
		            ->getOneOrNullResult()
			;
	}
    // /**
    //  * @return Cart[] Returns an array of Cart objects
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
    public function findOneBySomeField($value): ?Cart
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

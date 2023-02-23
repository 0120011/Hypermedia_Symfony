<?php

namespace App\Repository;

use App\Entity\PizzaBestellung;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PizzaBestellung>
 *
 * @method PizzaBestellung|null find($id, $lockMode = null, $lockVersion = null)
 * @method PizzaBestellung|null findOneBy(array $criteria, array $orderBy = null)
 * @method PizzaBestellung[]    findAll()
 * @method PizzaBestellung[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PizzaBestellungRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PizzaBestellung::class);
    }

    public function save(PizzaBestellung $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PizzaBestellung $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PizzaBestellung[] Returns an array of PizzaBestellung objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PizzaBestellung
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

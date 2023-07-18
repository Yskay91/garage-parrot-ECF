<?php

namespace App\Repository;

use App\Entity\Cars;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Cars>
 *
 * @method Cars|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cars|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cars[]    findAll()
 * @method Cars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cars::class);
    }

    public function save(Cars $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cars $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findFilteredCars($maxPrice = null, $maxKilometre = null)
    {
        $qb = $this->createQueryBuilder('c');

        if ($maxPrice !== null) {
            $qb->andWhere('c.price <= :maxPrice')
               ->setParameter('maxPrice', $maxPrice);
        }

        if ($maxKilometre !== null) {
            $qb->andWhere('c.kilometre <= :maxKilometre')
               ->setParameter('maxKilometre', $maxKilometre);
        }

        $query = $qb->getQuery();
        
        // Si aucun filtre n'est spécifié, renvoyer toutes les voitures
        if ($maxPrice === null && $maxKilometre === null) {
            return $qb->getQuery()->getResult();
        }

        return $query->getResult();
    }

}

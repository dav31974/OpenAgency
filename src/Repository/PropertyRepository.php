<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * Permet de récuperer tous les bien non vendu et filtrés
     *
     * @return Query
     */
    public function findAllVisibleQuery(PropertySearch $search)
    {
        $query = $this->findVisibleQuery();

        if($search->getMaxPrice()) {
            $query = $query
                ->andWhere('p.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }

        if($search->getMinSurface()) {
            $query = $query
                ->andWhere('p.surface >= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface());
        }

        if($search->getOptions()->count() > 0) {
            $k = 0;
            foreach($search->getOptions() as $k => $option) {
                $k++;
                $query = $query
                    ->andWhere(":option$k MEMBER OF p.options")
                    ->setParameter("option$k", $option);
            }
        }

        return $query->getQuery();
    }

    /**
     * permet de récupérer les dernier bien non vendu
     *
     * @return array
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
             ->setMaxResults(4)
             ->getQuery()
             ->getResult(); 
    }

    /**
     * Undocumented function
     *
     * @return QueryBuilder
     */
    private function findVisibleQuery()
    {
        return $this->createQueryBuilder('p')
            ->Where('p.sold = false');
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

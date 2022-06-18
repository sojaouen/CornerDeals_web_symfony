<?php

namespace App\Repository\Deal;

use App\Entity\Deal\Deal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Deal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deal[]    findAll()
 * @method Deal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deal::class);
    }

    // Méthode permettant la recherche de Deals
    public function search($query, $sort)
    {
        $stmt = $this->createQueryBuilder('d');

        // si la query est vide il n'y aura pas de filtrage donc cela sera équivalent à SELECT * FROM deals
        if (!empty($query)) {
            // Recherche sur le titre du deal
            // Recherche sur le nom de la catégorie
            // Recherche en fonction du nom de la boutique
            $stmt->leftJoin('d.categories', 'c');
            $stmt->leftJoin('d.merchant', 'm');

            $stmt->where('d.title LIKE :query');
            $stmt->orWhere('c.name LIKE :query');
            $stmt->orWhere('m.name LIKE :query');
            $stmt->setParameter('query', '%' . $query . '%');
        }

        // Pour filtrage sur la liste des deals
        switch ($sort) {
            // Plus récents
            case 'createdAt': //
                $stmt->orderBy('d.startAt', 'DESC');
                $stmt->andWhere('d.startAt < CURRENT_TIMESTAMP() ');
                $stmt->andWhere('d.endAt > CURRENT_TIMESTAMP() ');
                break;
            // Ordre alphabétique
            case 'title':
                $stmt->orderBy('d.' . $sort, 'ASC');
                break;
            // À venir
            case 'startAt':
                $stmt->andWhere('d.startAt > CURRENT_TIMESTAMP() ');
        }

        // On récupère la requête puis le résultat
        return $stmt->getQuery()->getResult();
    }
    // /**
    //  * @return Deal[] Returns an array of Deal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Deal
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

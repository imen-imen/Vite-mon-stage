<?php

namespace App\Repository;

use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Offer>
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    public function searchOffers(?string $title, ?string $localisation): array
{
    $qb = $this->createQueryBuilder('o');

    if ($title) {
        $qb->andWhere('o.title LIKE :title')
           ->setParameter('title', '%' . $title . '%');
    }

    if ($localisation) {
        $qb->andWhere('o.localisation LIKE :localisation')
           ->setParameter('localisation', '%' . $localisation . '%');
    }


    return $qb->getQuery()->getResult();
}


}

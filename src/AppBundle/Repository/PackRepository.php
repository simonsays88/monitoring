<?php

namespace AppBundle\Repository;

/**
 * PackRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PackRepository extends \Doctrine\ORM\EntityRepository
{

    public function getAllPacksOnGoing()
    {
        return $this->createQueryBuilder('c')
            ->where('c.status = :status')
            ->setParameter('status', 'ongoing')
            ->getQuery()
            ->getResult();
    }
}

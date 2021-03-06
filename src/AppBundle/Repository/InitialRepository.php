<?php

namespace AppBundle\Repository;

/**
 * InitialRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InitialRepository extends \Doctrine\ORM\EntityRepository
{

    public function getUncompletedInitialForm()
    {
        return $this->createQueryBuilder('i')
                ->where('i.completed = :completed')
                ->andWhere('i.createdAt = :date')
                ->setParameter('completed', false)
                ->setParameter('date', date('Y-m-d',strtotime('- 7 DAY')))
                ->getQuery()
                ->getResult();
    }
}
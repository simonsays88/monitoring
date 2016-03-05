<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Result;

/**
 * ResultRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResultRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function getUncompletedFourWeeks($nbDays)
    {
        return $this->createQueryBuilder('r')
                ->where('r.completed = :completed')
                ->andWhere('r.resultType = :resulType')
                ->andWhere('r.createdAt = :date')
                ->setParameter('completed', false)
                ->setParameter('resulType', Result::FOUR_WEEKS_FOOD_BODY)
                ->setParameter('date', date('Y-m-d',strtotime('- '.$nbDays.' DAY')))
                ->getQuery()
                ->getResult();
    }
    
    public function getUncompletedEsthetic()
    {
        return $this->createQueryBuilder('r')
                ->where('r.completed = :completed')
                ->andWhere('r.resultType = :resulType')
                ->andWhere('r.createdAt = :date')
                ->setParameter('completed', false)
                ->setParameter('resulType', Result::ESTHETIC)
                ->setParameter('date', date('Y-m-d',strtotime('- 7 DAY')))
                ->getQuery()
                ->getResult();
    }

}

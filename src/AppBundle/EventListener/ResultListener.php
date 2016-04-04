<?php
// src/AppBundle/EventListener/ResultListener.php
namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Result;
use AppBundle\Entity\Pack;


class ResultListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Result) {
            return;
        }

        $entityManager = $args->getEntityManager();
        $pack = $entity->getPack();
        if ($pack->getPackType() != Pack::FOOD) {
            $entity->setExercise($pack->getExercises());
            $entityManager->persist($entity);
            $entityManager->flush();
        }
    }
}
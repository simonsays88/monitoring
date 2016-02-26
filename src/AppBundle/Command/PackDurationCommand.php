<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Pack;

class PackDurationCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('costa:pack:pack-duration')
            ->setDescription("Start pack, end pack and decrement nd days of an ongoing pack")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $newPacks = $this->getContainer()->get('doctrine')
            ->getRepository("AppBundle:Pack")
            ->findBy(array('status' => Pack::STATUS_NEW));

        foreach ($newPacks as $newPack) {
            if ($newPack->getStartedAt()->format('Y-m-d') == date('Y-m-d')) {
                $newPack->setStatus(Pack::STATUS_ONGOING);
                $em->flush();
            } elseif ($newPack->getStartedAt()->format('Y-m-d') == date('Y-m-d', strtotime('+ 2 DAY'))) {
                //RELANCE
            }
        }

        $ongoingPacks = $this->getContainer()->get('doctrine')
            ->getRepository("AppBundle:Pack")
            ->findBy(array('status' => Pack::STATUS_ONGOING));

        foreach ($ongoingPacks as $ongoingPack) {
            $nbDays = $ongoingPack->getNbDays() - 1;
            $ongoingPack->setNbDays($nbDays);

            if($ongoingPack->getNbDays() == 0 && $ongoingPack->getNbStep() > $ongoingPack->getStep()){
                $ongoingPack->setStep($ongoingPack->getStep()+1);
                if($ongoingPack->getNbStep() == $ongoingPack->getStep()){
                    $ongoingPack->setStatus(Pack::STATUS_FINISHED);
                } elseif($ongoingPack->getNbStep() > $ongoingPack->getStep()) {
                    $ongoingPack->setNbDays(Pack::NB_DAYS);
                }
            }
        }
        $em->flush();

    }
}
<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Pack;

class ResumePackCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('costa:pack:resume')
            ->setDescription("Resume pack in pause")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $host = $this->getContainer()->getParameter('host');
        $this->getContainer()->get('router')->getContext()->setHost($host);
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $packs = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Pack")->getPacksToResume();

        foreach ($packs as $pack) {
            $pack->setStatus(Pack::STATUS_ONGOING);
            $em->flush();
        }
    }
}
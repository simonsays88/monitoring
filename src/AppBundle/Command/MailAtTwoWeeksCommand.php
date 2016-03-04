<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Pack;

class MailAtTwoWeeksCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
            ->setName('costa:mail:two-weeks')
            ->setDescription('Send mails at two weeks after pack beginning')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $ongoingPacks = $this->getContainer()->get('doctrine')
            ->getRepository("AppBundle:Pack")
            ->findBy(array('status' => Pack::STATUS_ONGOING));
    }
}

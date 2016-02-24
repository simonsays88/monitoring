<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IncrementNbDaysCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
            ->setName('costa:pack:increment-nb-days')
            ->setDescription("Increment nd days of a pack when he's not on pause")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $packs = $this->getContainer()->get('doctrine')
                    ->getRepository("AppBundle:Pack")
                     ->getAllPacksOnGoing();
        
        var_dump(count($packs));
    }
}

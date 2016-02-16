<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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

        var_dump('test');
    }
}

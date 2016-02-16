<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MailAtThreeMonthsCommand extends ContainerAwareCommand {

    protected function configure()
    {
        $this
            ->setName('costa:mail:three-months')
            ->setDescription('Send mails at three months after pack beginning')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        var_dump('test');
    }
}

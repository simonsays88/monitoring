<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Initial;

class ReminderCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('costa:email:reminder')
            ->setDescription("Send reminders")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $users = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Initial")->getUncompletedInitialForm();

        foreach ($users as $user) {
            $message = \Swift_Message::newInstance()
                ->setSubject('David costa : Bilan initial')
                ->setFrom('arnaud.wbc@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderUncompletedInitialForm.html.twig', array('user' => $user)),
                'text/html');
            $this->getContainer()->get('mailer')->send($message);
        }


        
    }
}
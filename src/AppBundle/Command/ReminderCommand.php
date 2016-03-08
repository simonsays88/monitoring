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
        $host = $this->getContainer()->getParameter('host');
        $this->getContainer()->get('router')->getContext()->setHost($host);
        $users = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Initial")->getUncompletedInitialForm();

        //Reminder initial result
        foreach ($users as $user) {
            $message = \Swift_Message::newInstance()
                ->setSubject('David costa : Bilan initial')
                ->setFrom($this->getContainer()->getParameter('sender'))
                ->setTo($user->getEmail())
                ->setBody(
                $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderInitialForm.html.twig', array('user' => $user)),
                'text/html');
            $this->getContainer()->get('mailer')->send($message);
        }
        
        $results = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Result")->getUncompletedFourWeeks(3);
        
        //Reminder four weeks result with 3 days late
        foreach ($results as $result) {
            $message = \Swift_Message::newInstance()
                ->setSubject('David costa : Bilan à 4 semaines')
                ->setFrom($this->getContainer()->getParameter('sender'))
                ->setTo($result->getPack()->getInitial()->getEmail())
                ->setBody(
                $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderFourWeeksSinceThreeDays.html.twig', array('result' => $result)),
                'text/html');
            $this->getContainer()->get('mailer')->send($message);
        }
        
        $results = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Result")->getUncompletedFourWeeks(7);

        //Reminder four weeks result with 7 days late
        
            foreach ($results as $result) {
            if ($result->getPack()->getDaysLeft() > 24) {
                $message = \Swift_Message::newInstance()
                        ->setSubject('David costa : Bilan à 4 semaines')
                        ->setFrom($this->getContainer()->getParameter('sender'))
                        ->setTo($result->getPack()->getInitial()->getEmail())
                        ->setBody(
                        $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderFourWeeksSinceSevenDays.html.twig', array('result' => $result)), 'text/html');
                $this->getContainer()->get('mailer')->send($message);
            }
        }

        $results = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Result")->getUncompletedFourWeeks(14);

        //Reminder four weeks result with 14 days late
        foreach ($results as $result) {
            if ($result->getPack()->getDaysLeft() > 24) {
                $message = \Swift_Message::newInstance()
                        ->setSubject('David costa : Bilan à 4 semaines')
                        ->setFrom($this->getContainer()->getParameter('sender'))
                        ->setTo($result->getPack()->getInitial()->getEmail())
                        ->setBody(
                        $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderFourWeeksSinceTwoWeeks.html.twig', array('result' => $result)), 'text/html');
                $this->getContainer()->get('mailer')->send($message);
            }
        }

        $results = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Result")->getUncompletedEsthetic();

        //Reminder esthetic result with 7 days late
        foreach ($results as $result) {
            $message = \Swift_Message::newInstance()
                    ->setSubject('David costa : Bilan à 3 mois')
                    ->setFrom('contact@davidcosta.fr')
                    ->setTo($result->getPack()->getInitial()->getEmail())
                    ->setBody(
                    $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderEstheticSinceSevenDays.html.twig', array('result' => $result)), 'text/html');
            $this->getContainer()->get('mailer')->send($message);
        }
    }
}
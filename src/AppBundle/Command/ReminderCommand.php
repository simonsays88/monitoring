<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Initial;
use AppBundle\Entity\Pack;

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

            $sujet = 'David costa : Rappel bilan initial';
            $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderInitialForm.html.twig', array('user' => $user));
            $destinataire = $user->getEmail();
            $headers = "From: \"".$this->getContainer()->getParameter('sender_custom')."\"<".$this->getContainer()->getParameter('sender_custom').">\n";
            $headers .= "Reply-To: ".$this->getContainer()->getParameter('sender_custom')."\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
            mail($destinataire,$sujet,$message,$headers);
        }
        
        $results = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Result")->getUncompletedFourWeeks(3);
        
        //Reminder four weeks result with 3 days late
        foreach ($results as $result) {

            $email = ($result->getPack()->getPackType() == Pack::THEME ) ? $this->getContainer()->getParameter('sender_themes') : $this->getContainer()->getParameter('sender_custom');
            $sujet = 'David costa : Rappel bilan à 4 semaines';
            $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderFourWeeksSinceThreeDays.html.twig', array('result' => $result));
            $destinataire = $result->getPack()->getInitial()->getEmail();
            $headers = "From: \"".$email."\"<".$email.">\n";
            $headers .= "Reply-To: ".$email."\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
            mail($destinataire,$sujet,$message,$headers);

        }
        
        $results = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Result")->getUncompletedFourWeeks(7);

        //Reminder four weeks result with 7 days late
        
            foreach ($results as $result) {
            if ($result->getPack()->getDaysLeft() > 24) {

            $email = ($result->getPack()->getPackType() == Pack::THEME ) ? $this->getContainer()->getParameter('sender_themes') : $this->getContainer()->getParameter('sender_custom');
            $sujet = 'David costa : Rappel bilan à 4 semaines';
            $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderFourWeeksSinceSevenDays.html.twig', array('result' => $result));
            $destinataire = $result->getPack()->getInitial()->getEmail();
            $headers = "From: \"".$email."\"<".$email.">\n";
            $headers .= "Reply-To: ".$email."\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
            mail($destinataire,$sujet,$message,$headers);
            
            }
        }

        $results = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Result")->getUncompletedFourWeeks(14);

        //Reminder four weeks result with 14 days late
        foreach ($results as $result) {
            if ($result->getPack()->getDaysLeft() > 24) {

            $email = ($result->getPack()->getPackType() == Pack::THEME) ? $this->getContainer()->getParameter('sender_themes') : $this->getContainer()->getParameter('sender_custom');
            $sujet = 'David costa : Rappel bilan à 4 semaines';
            $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderFourWeeksSinceTwoWeeks.html.twig', array('result' => $result));
            $destinataire = $result->getPack()->getInitial()->getEmail();
            $headers = "From: \"".$email."\"<".$email.">\n";
            $headers .= "Reply-To: ".$email."\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
            mail($destinataire,$sujet,$message,$headers);

            }
        }

        $results = $this->getContainer()->get('doctrine')->getRepository("AppBundle:Result")->getUncompletedEsthetic();

        //Reminder esthetic result with 7 days late
        foreach ($results as $result) {

            $email = ($result->getPack()->getPackType() == Pack::THEME ) ? $this->getContainer()->getParameter('sender_themes') : $this->getContainer()->getParameter('sender_custom');
            $sujet = 'David costa : Rappel bilan à 3 mois';
            $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:reminderEstheticSinceSevenDays.html.twig', array('result' => $result));
            $destinataire = $result->getPack()->getInitial()->getEmail();
            $headers = "From: \"".$email."\"<".$email.">\n";
            $headers .= "Reply-To: ".$email."\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
            mail($destinataire,$sujet,$message,$headers);

        }
    }
}
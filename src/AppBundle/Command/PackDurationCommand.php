<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Pack;
use AppBundle\Entity\Result;

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
        $host = $this->getContainer()->getParameter('host');
        $this->getContainer()->get('router')->getContext()->setHost($host);
        
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $newPacks = $this->getContainer()->get('doctrine')
            ->getRepository("AppBundle:Pack")
            ->findBy(array('status' => Pack::STATUS_NEW));

        foreach ($newPacks as $newPack) {
            if($newPack->getStartedAt()){
                if ($newPack->getStartedAt()->format('Y-m-d') == date('Y-m-d')) {
                    $newPack->setStatus(Pack::STATUS_ONGOING);
                }
            }
        }

        $ongoingPacks = $this->getContainer()->get('doctrine')
            ->getRepository("AppBundle:Pack")
            ->findBy(array('status' => Pack::STATUS_ONGOING));

        foreach ($ongoingPacks as $ongoingPack) {
            $daysLeft = $ongoingPack->getDaysLeft() - 1;
            if($daysLeft > 0){
                $ongoingPack->setDaysLeft($daysLeft);
            } elseif ($daysLeft == 0){
                $ongoingPack->setDaysLeft(0);
                $ongoingPack->setStatus(Pack::STATUS_FINISHED);
            }
            // one week before
            $nbDaysPassed = $ongoingPack->getNbDays() - $daysLeft + 7;

            $email = ($ongoingPack->getPackType() == Pack::THEME) ? $this->getContainer()->getParameter('sender_themes') : $this->getContainer()->getParameter('sender_custom');

            // Fin du pack (dernier bilan)
            if ($ongoingPack->getDaysLeft() == 7) {
                if ($ongoingPack->getNbDays() == 28){
                    
                        $result = new Result();
                        $result->setPack($ongoingPack);
                        $result->setCreatedAt(new \DateTime('now'));
                        $result->setResultType(Result::FOUR_WEEKS_FOOD_BODY);
                        $em->persist($result);
                        $em->flush();

                        $sujet = 'David costa : Bilan à 4 semaines';
                        $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:mailAtFourWeeks.html.twig', array('result' => $result));
                        $destinataire = $ongoingPack->getInitial()->getEmail();
                        $headers = "From: \"".$email."\"<".$email.">\n";
                        $headers .= 'Cc: simonsays92120@gmail.com' . "\r\n";
                        $headers .= "Reply-To: ".$email."\n";
                        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
                        mail($destinataire,$sujet,$message,$headers);
                        
                } else {
                $result = new Result();
                $result->setPack($ongoingPack);
                $result->setCreatedAt(new \DateTime('now'));
                $result->setResultType(Result::ESTHETIC);
                $em->persist($result);
                $em->flush();

                    $sujet = 'David costa : Bilan esthétique';
                    $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:mailAtThreeMonths.html.twig', array('result' => $result));
                    $destinataire = $ongoingPack->getInitial()->getEmail();
                    $headers = "From: \"".$email."\"<".$email.">\n";
                    $headers .= 'Cc: simonsays92120@gmail.com' . "\r\n";
                    $headers .= "Reply-To: ".$email."\n";
                    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
                    mail($destinataire,$sujet,$message,$headers);
                    
                }
            }
            
            //Bilan à 3 mois
            else if ($nbDaysPassed % 84 == 0 ) {
                $result = new Result();
                $result->setPack($ongoingPack);
                $result->setCreatedAt(new \DateTime('now'));
                $result->setResultType(Result::ESTHETIC);
                $em->persist($result);
                $em->flush();

                $sujet = 'David costa : Bilan esthétique';
                $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:mailAtThreeMonths.html.twig', array('result' => $result));
                $destinataire = $ongoingPack->getInitial()->getEmail();
                $headers = "From: \"".$email."\"<".$email.">\n";
                $headers .= 'Cc: simonsays92120@gmail.com' . "\r\n";
                $headers .= "Reply-To: ".$email."\n";
                $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
                mail($destinataire,$sujet,$message,$headers);
            }

            else if ($nbDaysPassed % 14 == 0){

                //Bilan à 2 semaines
                if(($nbDaysPassed/14 % 2 == 1)){
                    if ($ongoingPack->getPackType() == Pack::FOOD) {
                        $result = new Result();
                        $result->setPack($ongoingPack);
                        $result->setCreatedAt(new \DateTime('now'));
                        $result->setResultType(Result::TWO_WEEKS_FOOD);
                        $em->persist($result);
                        $em->flush();
                        
                        $sujet = 'David costa : Bilan à 2 semaines';
                        $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:mailAtTwoWeeks.html.twig', array('result' => $result));
                        $destinataire = $ongoingPack->getInitial()->getEmail();
                        $headers = "From: \"".$email."\"<".$email.">\n";
                        $headers .= 'Cc: simonsays92120@gmail.com' . "\r\n";
                        $headers .= "Reply-To: ".$email."\n";
                        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
                        mail($destinataire,$sujet,$message,$headers);
                        
                    } else if($ongoingPack->getPackType() == Pack::FOOD_BODY){
                        $result = new Result();
                        $result->setPack($ongoingPack);
                        $result->setCreatedAt(new \DateTime('now'));
                        $result->setResultType(Result::TWO_WEEKS_FOOD_BODY);
                        $em->persist($result);
                        $em->flush();

                        $sujet = 'David costa : Bilan à 2 semaines';
                        $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:mailAtTwoWeeks.html.twig', array('result' => $result));
                        $destinataire = $ongoingPack->getInitial()->getEmail();
                        $headers = "From: \"".$email."\"<".$email.">\n";
                        $headers .= 'Cc: simonsays92120@gmail.com' . "\r\n";
                        $headers .= "Reply-To: ".$email."\n";
                        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
                        mail($destinataire,$sujet,$message,$headers);    
                    }
                }
                //Bilan à 4 semaines
                else {
                    if($ongoingPack->getPackType() == Pack::FOOD){
                        
                        $result = new Result();
                        $result->setPack($ongoingPack);
                        $result->setCreatedAt(new \DateTime('now'));
                        $result->setResultType(Result::FOUR_WEEKS_FOOD);
                        $em->persist($result);
                        $em->flush();

                        $sujet = 'David costa : Bilan à 4 semaines';
                        $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:mailAtFourWeeks.html.twig', array('result' => $result));
                        $destinataire = $ongoingPack->getInitial()->getEmail();
                        $headers = "From: \"".$email."\"<".$email.">\n";
                        $headers .= 'Cc: simonsays92120@gmail.com' . "\r\n";
                        $headers .= "Reply-To: ".$email."\n";
                        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
                        mail($destinataire,$sujet,$message,$headers); 

                    } else if($ongoingPack->getPackType() == Pack::FOOD_BODY || $ongoingPack->getPackType() == Pack::THEME){

                        $result = new Result();
                        $result->setPack($ongoingPack);
                        $result->setCreatedAt(new \DateTime('now'));
                        $result->setResultType(Result::FOUR_WEEKS_FOOD_BODY);
                        $em->persist($result);
                        $em->flush();
                        
                        $sujet = 'David costa : Bilan à 4 semaines';
                        $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:mailAtFourWeeks.html.twig', array('result' => $result));
                        $destinataire = $ongoingPack->getInitial()->getEmail();
                        $headers = "From: \"".$email."\"<".$email.">\n";
                        $headers .= 'Cc: simonsays92120@gmail.com' . "\r\n";
                        $headers .= "Reply-To: ".$email."\n";
                        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
                        mail($destinataire,$sujet,$message,$headers);
                    }
                }

            }

            
        }
        $em->flush();
    }
}

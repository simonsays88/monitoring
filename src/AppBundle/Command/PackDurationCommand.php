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
            if ($newPack->getStartedAt()->format('Y-m-d') == date('Y-m-d')) {
                $newPack->setStatus(Pack::STATUS_ONGOING);
            }
        }

        $ongoingPacks = $this->getContainer()->get('doctrine')
            ->getRepository("AppBundle:Pack")
            ->findBy(array('status' => Pack::STATUS_ONGOING));

        foreach ($ongoingPacks as $ongoingPack) {
            $daysLeft = $ongoingPack->getDaysLeft() - 1;
            $ongoingPack->setDaysLeft($daysLeft);

            $nbDaysPassed = $ongoingPack->getNbDays() - $daysLeft;

            // Fin du pack (dernier bilan)
            if ($ongoingPack->getDaysLeft() == 0) {

                $result = new Result();
                $result->setPack($ongoingPack);
                $result->setCreatedAt(new \DateTime('now'));
                $result->setResultType(Result::ESTHETIC);
                $em->persist($result);
                $em->flush();

                $ongoingPack->setStatus(Pack::STATUS_FINISHED);
                    $message = \Swift_Message::newInstance()
                        ->setSubject('David costa : Bilan esthétique')
                        ->setFrom('arnaud.wbc@gmail.com')
                        ->setTo($ongoingPack->getInitial()->getEmail())
                        ->setBody(
                    $this->getContainer()->get('templating')->render('AppBundle:Emails:mailAtThreeMonths.html.twig', array('result' => $result)),
                    'text/html');
                    $this->getContainer()->get('mailer')->send($message);
            }
            
            //Bilan à 3 mois
            else if ($nbDaysPassed % 90 == 0 ) {
                
                $result = new Result();
                $result->setPack($ongoingPack);
                $result->setCreatedAt(new \DateTime('now'));
                $result->setResultType(Result::ESTHETIC);
                $em->persist($result);
                $em->flush();

                $message = \Swift_Message::newInstance()
                    ->setSubject('David costa : Bilan esthétique')
                    ->setFrom('arnaud.wbc@gmail.com')
                    ->setTo($ongoingPack->getInitial()->getEmail())
                    ->setBody(
                $this->getContainer()->get('templating')->render('AppBundle:Emails:mailAtThreeMonths.html.twig', array('result' => $result)),
                'text/html');
                $this->getContainer()->get('mailer')->send($message);
            }

            else if ($nbDaysPassed % 14 == 0){

                //Bilan à 2 semaines
                if(($nbDaysPassed/14 % 2 == 1)){
                    if($ongoingPack->getPackType() == Pack::FOOD){

                    } else if($ongoingPack->getPackType() == Pack::FOOD_BODY){
                        
                    }
                }
                //Bilan à 4 semaines
                else {
                    if($ongoingPack->getPackType() == Pack::THEMES){
                        
                    } else if($ongoingPack->getPackType() == Pack::FOOD){

                    } else if($ongoingPack->getPackType() == Pack::FOOD_BODY){
                        
                    }
                }

            }

            
        }
        $em->flush();

    }
}
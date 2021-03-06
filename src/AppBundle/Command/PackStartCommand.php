<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputDefinition;
use AppBundle\Entity\Pack;
use AppBundle\Entity\Initial;
use AppBundle\Entity\Category;

class PackStartCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('costa:pack:start')
            ->setDescription("Process pack")
            ->setDefinition(
                    new InputDefinition(array(
                        new InputOption('pack_name', null, InputOption::VALUE_REQUIRED),
                        new InputOption('pack_type_id', null, InputOption::VALUE_REQUIRED),
                        new InputOption('user_id', null, InputOption::VALUE_REQUIRED),
                        new InputOption('nb_days', null, InputOption::VALUE_REQUIRED),
                        new InputOption('ebook', null, InputOption::VALUE_NONE),
                        new InputOption('videos', null, InputOption::VALUE_NONE),
                        new InputOption('ebook_double', null, InputOption::VALUE_NONE),
                        new InputOption('ebook_tips', null, InputOption::VALUE_NONE),
                        new InputOption('ebook_recipes', null, InputOption::VALUE_NONE),
                    )));

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $host = $this->getContainer()->getParameter('host');
        $this->getContainer()->get('router')->getContext()->setHost($host);
        
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $packs_themes = array('4278','3839','2624','2773','2610','2617','2665','3192');
        
        $pack_type_id = $input->getOption('pack_type_id');
            if($pack_type_id == 2641 || $pack_type_id == 2871){
                $pack_type = 'food';
            } elseif($pack_type_id == 2647){
                $pack_type = 'food_body';
            } elseif(in_array($pack_type_id, $packs_themes)){
                $pack_type = 'themes';
            }
            
            $duration = $input->getOption('nb_days');
            if ($duration == '1 mois') {
                $nb_days = 28;
            } else {
                $nb = preg_replace('/\D/', '', $duration);
                $nb_days = $nb * 28;
            }
            $initial = $this->getContainer()->get('doctrine')
            ->getRepository("AppBundle:Initial")
            ->findOneBy(array('userId' => $input->getOption('user_id')));

            $startAt = null;
            $send = false;
            if (!$initial) {
                $initial = new Initial();
                $initial->setUserId($input->getOption('user_id'));
                $initial->setCreatedAt(new \DateTime());
                $sql  = "SELECT user_email FROM wp_users WHERE id = ?";
                $stmt = $em->getConnection()->prepare($sql);
                $stmt->bindValue(1, $input->getOption('user_id'));
                if ($stmt->execute()) {
                    $result = $stmt->fetch();
                    $initial->setEmail($result['user_email']);
                }
                $em->persist($initial);
                $em->flush();
            } else {
                $send = true;
            }
        $pack = new Pack();
        $pack->setUserId($input->getOption('user_id'));
        $pack->setPackTypeId($pack_type_id);
        $pack->setPackName($input->getOption('pack_name'));
        $pack->setDaysLeft($nb_days);
        $pack->setNbDays($nb_days);
        $pack->setInitial($initial);
        $pack->setCreatedAt(new \DateTime());
        $pack->setStartedAt($startAt);
        $pack->setStatus('new');
        $category = $this->getContainer()->get('doctrine')
            ->getRepository("AppBundle:Category")
            ->findOneBy(array('name' => $pack_type));
        $pack->setPackType($pack_type);
        $pack->setCategory($category);
        if($input->getOption('ebook')){
            $pack->setEbook(true);
        }
        if($input->getOption('videos')){
            $pack->setVideos(true);
        }
        if($input->getOption('ebook_double')){
            $pack->setEbookDouble(true);
        }
        if($input->getOption('ebook_tips')){
            $pack->setEbookTips(true);
        }
        if($input->getOption('ebook_recipes')){
            $pack->setEbookRecipes(true);
        }
        $exercises = $category->getExercises();

        foreach($exercises as $exercise){
            $pack->addExercise($exercise);
        }

        $em->persist($pack);
        $em->flush();

        if ($send) {
            $email = ($pack_type == Pack::THEME) ? $this->getContainer()->getParameter('sender_themes') : $this->getContainer()->getParameter('sender_custom');
            $sujet = 'Bilan pack complété';
            $message = $this->getContainer()->get('templating')->render('AppBundle:Emails:packPreparation.html.twig', array('pack' => $pack));
            $destinataire = $email;
            $headers = "From: \"" . $this->getContainer()->getParameter('sender_app') . "\"<" . $this->getContainer()->getParameter('sender_app') . ">\n";
            $headers .= "Reply-To: " . $this->getContainer()->getParameter('sender_app') . "\n";
            $headers .= "Content-Type: text/html; charset=\"utf-8\"";
            mail($destinataire, $sujet, $message, $headers);
        }
    }
}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Initial;
use AppBundle\Form\Type\InitialType;
use Symfony\Component\HttpFoundation\Response;

class InitialController extends Controller
{

    /**
     * @Route("/suivi-initial/{userId}", name="initial", requirements={"userId"="\d+"})
     */
    public function editAction(Request $request, $userId)
    {
        $initialEntity = $this->getDoctrine()
            ->getRepository('AppBundle:Initial')
            ->findOneBy(array('userId' => $userId));

        if ($initialEntity) {

            $initialPhotoFront = $initialEntity->getPhotoFront();
            $initialPhotoSide = $initialEntity->getPhotoSide();
            $initialPhotoBack = $initialEntity->getPhotoBack();
            $form = $this->createForm(InitialType::class, $initialEntity);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $initial = $form->getData();

                $dir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/photos';

                if ($photoFront = $initial->getPhotoFront()) {
                    $photoFrontName = md5(uniqid()) . '.' . $photoFront->guessExtension();
                    $photoFront->move($dir, $photoFrontName);
                    $initial->setPhotoFront($photoFrontName);
                } else {
                    $initial->setPhotoFront($initialPhotoFront);
                }
                if ($photoSide = $initial->getPhotoSide()) {
                    $photoSideName = md5(uniqid()) . '.' . $photoSide->guessExtension();
                    $photoSide->move($dir, $photoSideName);
                    $initial->setPhotoSide($photoSideName);
                } else {
                    $initial->setPhotoSide($initialPhotoSide);
                }
                if ($photoBack = $initial->getPhotoBack()) {
                    $photoBackName = md5(uniqid()) . '.' . $photoBack->guessExtension();
                    $photoBack->move($dir, $photoBackName);
                    $initial->setPhotoBack($photoBackName);
                } else {
                    $initial->setPhotoBack($initialPhotoBack);
                }
                if ($initial->getCompleted() == false) {
                    $weekDay = date('w');
                    $date = new \DateTime();
                    if ($weekDay < 5) {
                        $ndDaysUntilNextMonday = 8 - $weekDay;
                        $startAt = $date->add(new \DateInterval('P'.$ndDaysUntilNextMonday.'D'));
                    } else {
                        $ndDaysUntilNextNextMonday = 15 - $weekDay;
                        $startAt = $date->add(new \DateInterval('P'.$ndDaysUntilNextMonday.'D'));
                    }
                    $initial->setCompleted(true);

                    foreach ($initial->getPacks() as $pack) {
                        $pack->setStartedAt($startAt);
                        $message = \Swift_Message::newInstance()
                            ->setSubject('Préparation du pack')
                            ->setFrom('arnaud.wbc@gmail.com')
                            ->setTo('arnaudsimon921@yahoo.fr')
                            ->setBody(
                            $this->renderView('AppBundle:Emails:packPreparation.html.twig', array('pack' => $pack)),
                            'text/html');
                        $this->get('mailer')->send($message);
                    }                    
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($initial);
                $em->flush();


                return $this->render('AppBundle:Initial:success.html.twig');
            }


            return $this->render('AppBundle:Initial:edit.html.twig',
                    array(
                    'user_id' => $userId,
                    'form' => $form->createView()
            ));
        } else {
            return new Response('Bilan introuvable', 500);
        }
    }
}
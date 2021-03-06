<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Initial;
use AppBundle\Entity\Pack;
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
                    $initial->setCompleted(true);

                    foreach ($initial->getPacks() as $pack) {
                        $email = ($pack->getPackType() == Pack::THEME) ? $this->container->getParameter('sender_themes') : $this->container->getParameter('sender_custom');
                        $sujet = 'Bilan pack complété';
                        $message = $this->renderView('AppBundle:Emails:packPreparation.html.twig', array('pack' => $pack));
                        $destinataire = $email;
                        $headers = "From: \"".$this->container->getParameter('sender_app')."\"<".$this->container->getParameter('sender_app').">\n";
                        $headers .= "Reply-To: ".$this->container->getParameter('sender_app')."\n";
                        $headers .= "Content-Type: text/html; charset=\"utf-8\"";
                        mail($destinataire, $sujet, $message, $headers);
                    }
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($initial);
                $em->flush();


                return $this->render('AppBundle:Initial:success.html.twig', array('initial' => $initial));
            }


            return $this->render('AppBundle:Initial:edit.html.twig',
                    array(
                    'user_id' => $userId,
                    'form' => $form->createView(),
                    'initial' => $initialEntity
            ));
        } else {
            return new Response('Bilan introuvable', 500);
        }
    }

    /**
     * @Route("/completed/{id}", name="initial_completed", requirements={"id"="\d+"})
     */
    public function completedAction(Request $request, $id)
    {
        $initial = $this->getDoctrine()
            ->getRepository('AppBundle:Initial')
            ->findOneById($id);
        if($initial->getCompleted()){
            $initial->setCompleted(0);
        } else{
            $initial->setCompleted(1);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($initial);
        $em->flush();
        return new Response();
    }
}
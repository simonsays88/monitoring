<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Result;
use AppBundle\Form\Type\ResultType;
use Symfony\Component\HttpFoundation\Response;

class ResultsController extends Controller
{

    /**
     * @Route("/bilan/{resultId}", name="results", requirements={"resultId"="\d+"})
     */
    public function editAction(Request $request, $resultId)
    {
        $result = $this->getDoctrine()
            ->getRepository('AppBundle:Result')
            ->findOneById($resultId);
        $initialPhotoFront = $initialEntity->getPhotoFront();
        $initialPhotoSide = $initialEntity->getPhotoSide();
        $initialPhotoBack = $initialEntity->getPhotoBack();
        
        if ($result) {
            $form = $this->createForm(ResultType::class, $result);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $result     = $form->getData();
                
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

                $result->setCompleted(true);

                $em = $this->getDoctrine()->getManager();
                $em->persist($result);
                $em->flush();
            }
            return $this->render('AppBundle:Results:edit.html.twig',
                    array(
                    'form' => $form->createView()
            ));
        } else {
            return new Response('Bilan introuvable', 500);
        }
    }
}
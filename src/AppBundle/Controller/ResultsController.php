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
        
        if ($result) {
            
            $initialPhotoFront = $result->getPhotoFront();
            $initialPhotoSide = $result->getPhotoSide();
            $initialPhotoBack = $result->getPhotoBack();
            $form = $this->createForm(ResultType::class, $result);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $result     = $form->getData();
                
                $dir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/photos';

                if ($photoFront = $result->getPhotoFront()) {
                    $photoFrontName = md5(uniqid()) . '.' . $photoFront->guessExtension();
                    $photoFront->move($dir, $photoFrontName);
                    $result->setPhotoFront($photoFrontName);
                } else {
                    $result->setPhotoFront($initialPhotoFront);
                }
                if ($photoSide = $result->getPhotoSide()) {
                    $photoSideName = md5(uniqid()) . '.' . $photoSide->guessExtension();
                    $photoSide->move($dir, $photoSideName);
                    $result->setPhotoSide($photoSideName);
                } else {
                    $result->setPhotoSide($initialPhotoSide);
                }
                if ($photoBack = $result->getPhotoBack()) {
                    $photoBackName = md5(uniqid()) . '.' . $photoBack->guessExtension();
                    $photoBack->move($dir, $photoBackName);
                    $result->setPhotoBack($photoBackName);
                } else {
                    $result->setPhotoBack($initialPhotoBack);
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
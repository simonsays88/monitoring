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
            $form = $this->createForm(ResultType::class, $result);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $result     = $form->getData();
                $photoFront = $result->getPhotoFront();
                $photoSide  = $result->getPhotoSide();
                $photoBack  = $result->getPhotoBack();

                $photoFrontName = md5(uniqid()).'.'.$photoFront->guessExtension();
                $photoSideName  = md5(uniqid()).'.'.$photoSide->guessExtension();
                $photoBackName  = md5(uniqid()).'.'.$photoBack->guessExtension();

                $dir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/photos/bilans';
                $photoFront->move($dir, $photoFrontName);
                $photoSide->move($dir, $photoSideName);
                $photoBack->move($dir, $photoBackName);

                $result->setPhotoFront($photoFrontName);
                $result->setPhotoSide($photoSideName);
                $result->setPhotoBack($photoBackName);

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
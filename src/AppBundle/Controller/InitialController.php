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
     * @Route("/suivi-initial/{userId}", name="initial", requirements={"user_id"="\d+"})
     */
    public function editAction(Request $request, $userId)
    {
        $initial = $this->getDoctrine()
            ->getRepository('AppBundle:Initial')
            ->findOneBy(array('userId' => $userId));

        $form = $this->createForm(InitialType::class, $initial);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $initial = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($initial);
            $em->flush();
        }

        if ($initial) {
            return $this->render('AppBundle:Initial:edit.html.twig',
                    array(
                    'user_id' => $userId,
                    'form' => $form->createView()
            ));
        } else {
            return new Response('Wrong method', 500);
        }
    }
}
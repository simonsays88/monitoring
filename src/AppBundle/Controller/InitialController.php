<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Monitoring;

class InitialController extends Controller
{

    /**
     * @Route("/suivi-initial/{user_id}", name="initial", requirements={"user_id"="\d+"})
     */
    public function editAction(Request $request, $userId)
    {
        $monitoring = $this->getDoctrine()
            ->getRepository('AppBundle:Monitoring')
            ->findOneBy(array('userId' => $userId));
        if ($monitoring) {

            
            return $this->render('AppBundle:Initial:edit.html.twig',
                    ['user_id' => $user_id]);
        } else {
            return new Response('Wrong method', 500,
                array('Content-Type' => 'text/xml'));
        }
    }
}
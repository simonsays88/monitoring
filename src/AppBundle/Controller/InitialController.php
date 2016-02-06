<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InitialController extends Controller
{
    /**
     * @Route("/suivi-initial/{user_id}", name="initial", requirements={"user_id"="\d+"})
     */
    public function editAction(Request $request,$user_id)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Initial:edit.html.twig', [
            'user_id'=> $user_id
        ]);
    }
}

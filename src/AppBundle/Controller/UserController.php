<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    /**
     * @Route("/utilisateurs", name="user_list")
     */
    public function listAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('AppBundle:User:list.html.twig');
    }

    /**
     * @Route("/utilisateurs/{user_id}", name="user", requirements={"user_id"="\d+"})
     */
    public function showAction(Request $request, $user_id) {
        // replace this example code with whatever you need
        return $this->render('AppBundle:User:show.html.twig', [
                    'user_id' => $user_id,
        ]);
    }

}

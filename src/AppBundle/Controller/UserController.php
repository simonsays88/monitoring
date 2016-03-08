<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class UserController extends Controller
{

    /**
     * @Route("/utilisateurs", name="user_list")
     */
    public function listAction(Request $request)
    {

        $users = $this->getDoctrine()
            ->getRepository('AppBundle:Initial')
            ->findAll();

        return $this->render('AppBundle:User:list.html.twig',
                [
                'users' => $users,
        ]);
    }

    /**
     * @Route("/utilisateurs/{user_id}", name="user", requirements={"user_id"="\d+"})
     */
    public function showAction(Request $request, $user_id)
    {
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:Initial')
            ->findOneBy(array('userId' => $user_id));
        if ($user) {
            // replace this example code with whatever you need
            return $this->render('AppBundle:User:show.html.twig',
                    [
                    'user' => $user,
            ]);
        } else {
            return new Response('Utilisateur introuvable', 500);
        }
    }
}
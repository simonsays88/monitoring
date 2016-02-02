<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MonitoringController extends Controller
{
    /**
     * @Route("/suivi-pack/{id}", name="monitoring", requirements={"id"="\d+"})
     */
    public function indexAction(Request $request, $id)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Monitoring:index.html.twig', [
            'id'=> $id
        ]);
    }
}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ResultsController extends Controller
{
    /**
     * @Route("/bilan/{user_id}/{pack_id}/{step}", name="results", requirements={"user_id"="\d+", "pack_id"="\d+" , "step"="\d+" })
     */
    public function editAction(Request $request,$user_id, $pack_id, $step)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Results:edit.html.twig', [
            'user_id'=> $user_id,
            'pack_id'=> $pack_id,
            'step'=> $step,
        ]);
    }
}

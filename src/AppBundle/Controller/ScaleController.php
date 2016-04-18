<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Scale controller.
 *
 * @Route("/bareme")
 */
class ScaleController extends Controller
{
    /**
     *
     * @Route("/", name="scale_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Scale:index.html.twig');
    }
}

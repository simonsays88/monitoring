<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Pack;
use AppBundle\Entity\Monitoring;

class OrderController extends Controller
{

    /**
     * @Route("/commande", name="order")
     */
    public function postAction(Request $request)
    {
        if ($request->isMethod('POST')) {

            $userId     = $request->request->get('user_id');
            $packTypeId = $request->request->get('pack_type_id');
            $packName   = $request->request->get('pack_name');
            $nbStep     = $request->request->get('nb_step');

            try {
                $em = $this->getDoctrine()->getManager();

                $monitoring = $this->getDoctrine()
                    ->getRepository('AppBundle:Monitoring')
                    ->findOneBy(array('userId' => $userId));
                if (!$monitoring) {
                    $monitoring = new Monitoring();
                    $monitoring->setUserId($userId);
                    $em->persist($monitoring);
                    $em->flush();
                }

                $pack = new Pack();
                $pack->setUserId($userId);
                $pack->setNbStep($nbStep);
                $pack->setPackTypeId($packTypeId);
                $pack->setPackName($packName);
                $pack->setMonitoring($monitoring);
                $pack->setCreatedAt(new \DateTime('now'));
                $weekDay = date('w');
                if($weekDay < 5){
                    $ndDaysUntilNextMonday = 8 - $weekDay;
                    $startAt = date('d/m/Y', strtotime("+".$ndDaysUntilNextMonday." day"));
                } else{
                    $ndDaysUntilNextNextMonday = 15 - $weekDay;
                    $startAt = date('d/m/Y', strtotime("+".$ndDaysUntilNextNextMonday." day"));
                }

                $em->persist($pack);
                $em->flush();
                
            } catch(\Exception $e) {
                return new Response($e->getMessage(), 500,
                    array('Content-Type' => 'text/xml'));
            }

            return new Response($userId, 200,
                array('Content-Type' => 'text/xml'));
        } else {
            return new Response('Wrong method', 500,
                array('Content-Type' => 'text/xml'));
        }
    }
}
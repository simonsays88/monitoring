<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Pack;
use AppBundle\Form\PackType;

/**
 * Pack controller.
 *
 * @Route("/pack")
 */
class PackController extends Controller
{
    /**
     * Lists all Pack entities.
     *
     * @Route("/", name="pack_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $completed = $request->query->get('completed');
        $pack_standby = $request->query->get('pack_standby');
        $packTypeId = $request->query->get('packTypeId');
        $name = $request->query->get('name');
        $em = $this->getDoctrine()->getManager();
        $date = new \DateTime('now');

        if($this->getUser()->getId() == 1) {
            $packs = $em->getRepository('AppBundle:Pack')->getAllPacksFoodAndFoodBody($completed, $packTypeId, $name);
        } else {
            $packs = $em->getRepository('AppBundle:Pack')->getAllPacksThemes($completed, $packTypeId, $name);
        }
        
        if($pack_standby != 'all'){
            
            foreach ($packs as $key => $pack){
                $results  = $pack->getResults();
                $result = $results->last();
                if($result){
                    if(count($results) > 1 && $result->getCreatedAt()->modify('+1 week') > $date){
                        $result = $results[(count($results) - 2)];
                    }
                    if($result->getDone() || !$result->getCompleted()){
                        unset($packs[$key]);
                    }
                } else {
                    unset($packs[$key]);
                }
            }
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $packs, $request->query->getInt('page', 1), 100
        );
        return $this->render('pack/index.html.twig',
                array(
                'packs' => $pagination,
                'completed' => $completed,
                'pack_standby' => $pack_standby,
                'packTypeId' => $packTypeId
        ));
    }

    /**
     * Displays a form to edit an existing Pack entity.
     *
     * @Route("/{id}/edit", name="pack_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pack $pack)
    {
        $editForm = $this->createForm('AppBundle\Form\Type\PackType', $pack);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pack);
            $em->flush();

            return $this->redirectToRoute('pack_edit', array('id' => $pack->getId()));
        }

        return $this->render('pack/edit.html.twig', array(
            'pack' => $pack,
            'edit_form' => $editForm->createView(),
        ));
    }
}

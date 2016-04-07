<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Pack;
use AppBundle\Form\Type\InfosType;
use Symfony\Component\HttpFoundation\Response;

class InfosController extends Controller
{

    /**
     * @Route("/infos/{id}", name="infos", requirements={"id"="\d+"})
     */
    public function editAction(Request $request, $id)
    {
        $pack = $this->getDoctrine()
            ->getRepository('AppBundle:Pack')
            ->findOneById($id);

        if ($pack) {
            $form = $this->createForm(InfosType::class, $pack);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $pack = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($pack);
                $em->flush();

                return $this->redirectToRoute('pack_index');
            }

            return $this->render('AppBundle:Infos:edit.html.twig',
                    array(
                    'form' => $form->createView(),
            ));
        } else {
            return new Response('pack introuvable', 500);
        }
    }
}
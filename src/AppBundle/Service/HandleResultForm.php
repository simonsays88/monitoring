<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Templating\EngineInterface;
use AppBundle\Entity\Pack;


class HandleResultForm
{
    /** @var \Doctrine\ORM\EntityManager  */
    protected $em;

    protected $templating;


    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, EngineInterface $templating)
    {
        $this->em = $em;
        $this->templating = $templating;
    }

    public function process($request, $form)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();
            $result->setCompleted(true);
            $this->em->persist($result);
            $this->em->flush();

            $destinataire = ($result->getPack()->getPackType() == Pack::THEME) ? $this->container->getParameter('sender_themes') : $this->container->getParameter('sender_custom');
            $sujet = 'Pack en pause';
            $message = $this->renderView('AppBundle:Emails:resultsCompleted.html.twig', array('result' => $result));
            $headers = "From: \"".$this->container->getParameter('sender_app')."\"<".$this->container->getParameter('sender_app').">\n";
            $headers .= "Reply-To: ".$this->container->getParameter('sender_app')."\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
            mail($destinataire, $sujet, $message, $headers);
            return true;
        } else {
            return false;
        }
    }
}

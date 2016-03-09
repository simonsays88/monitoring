<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Templating\EngineInterface;


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
            
            return true;
        } else {
            return false;
        }
    }
}

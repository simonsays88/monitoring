<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    protected $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array(
            'get_reference' => new \Twig_Function_Method($this, 'getReference')
        );
    }

    public function getReference($id) {
        $exercise = $this->em->getRepository('AppBundle:Exercise')->findOneById($id);

        return $exercise->getReference();
    }

    public function getName()
    {
        return 'app_extension';
    }

}
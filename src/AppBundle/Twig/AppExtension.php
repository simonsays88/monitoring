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
            'get_reference' => new \Twig_Function_Method($this, 'getReference'),
            'get_email_wordpress' => new \Twig_Function_Method($this, 'getEmailWordpress'),
            'fmod' => new \Twig_Function_Method($this, 'fmod')
        );
    }

    public function getReference($id) {
        $exercise = $this->em->getRepository('AppBundle:Exercise')->findOneById($id);

        return $exercise->getReference();
    }

    public function getEmailWordpress($id) {
        $sql  = "SELECT user_email FROM wp_users WHERE id = ?";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->bindValue(1, $id);
        if ($stmt->execute()) {
            $result = $stmt->fetch();
            if ($result['user_email']) {
                return $result['user_email'];
            } else {
                $initial = $this->em->getRepository('AppBundle:Initial')->findOneByUserId($id);
                return $initial->getEmail();
            }
        } 
        return false;
    }
    
    public function fmod($x, $y) {
        return fmod($x, $y);
    }

    public function getName()
    {
        return 'app_extension';
    }

}
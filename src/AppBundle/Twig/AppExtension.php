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
            'get_email_wordpress' => new \Twig_Function_Method($this, 'getEmailWordpress')
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
            return $result['user_email'];
        }
        return false;
    }

    public function getName()
    {
        return 'app_extension';
    }

}
<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Utilisateurs', array('route' => 'pack_index'));
        $menu->addChild('Exercices', array('route' => 'exercise_index'));
        $menu->addChild('Catégorie de packs', array('route' => 'category_index'));
        $menu->addChild('Barème des performances', array('route' => 'scale_index'));
        $menu->addChild('Déconnexion', array('route' => 'fos_user_security_logout'));

        return $menu;
    }
}
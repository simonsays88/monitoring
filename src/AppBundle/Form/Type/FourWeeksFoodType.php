<?php

// src/AppBundle/Form/Type/FourWeeksFoodType.php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FourWeeksFoodType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('questions', null, array('required' => true))
                ->add('evaluation', null, array('required' => true))
                ->add('physicalChange', null, array('required' => true))
                ->add('hipSize', null, array('required' => true))
                ->add('weight', null, array('required' => true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Result'
        ));
    }

}

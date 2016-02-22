<?php

// src/AppBundle/Form/Type/InitialType.php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ResultType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('weight', null, array('required' => true))
                ->add('imc', null, array('required' => true))
                ->add('shoulders', null, array('required' => true))
                ->add('pectorals', null, array('required' => true))
                ->add('arms', null, array('required' => true))
                ->add('hipSize', null, array('required' => true))
                ->add('thighs', null, array('required' => true))
                ->add('photoFront', FileType::class, array('data_class' => null))
                ->add('photoSide', FileType::class, array('data_class' => null))
                ->add('photoBack', FileType::class, array('data_class' => null))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Result'
        ));
    }

}

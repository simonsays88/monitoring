<?php

// src/AppBundle/Form/Type/FourWeeksFoodBodyType.php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\Type\ResultExerciseType;

class FourWeeksFoodBodyType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('method', null, array('required' => true))
                ->add('feedback', null, array('required' => true))
                ->add('performance', null, array('required' => true))
                ->add('recovery', null, array('required' => true))
                ->add('pace', null, array('required' => true))
                ->add('questions', null, array('required' => true))
                ->add('evaluation', null, array('required' => true))
                ->add('physicalChange', null, array('required' => true))
                ->add('hipSize', null, array('required' => true))
                ->add('weight', null, array('required' => true))
                ->add('resultExercise', CollectionType::class, array('entry_type' => ResultExerciseType::class))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Result'
        ));
    }

}

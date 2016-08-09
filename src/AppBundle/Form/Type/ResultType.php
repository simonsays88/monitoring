<?php

// src/AppBundle/Form/Type/InitialType.php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
                ->add('photoFront', FileType::class, array('data_class' => null, 'required' => is_null($builder->getData()->getPhotoFront())))
                ->add('photoSide', FileType::class, array('data_class' => null, 'required' => is_null($builder->getData()->getPhotoSide())))
                ->add('photoBack', FileType::class, array('data_class' => null, 'required' => is_null($builder->getData()->getPhotoBack())))
                ->add('questions', null, array('required' => false))
                ->add('evaluation', null, array('required' => false))
                ->add('physicalChange', null, array('required' => false))
                ->add('method', null, array('required' => false))
                ->add('feedback', null, array('required' => false))
                ->add('performance', null, array('required' => false))
                ->add('recovery', null, array('required' => false))
                ->add('resultExercise', CollectionType::class, array('entry_type' => ResultExerciseType::class))

        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Result'
        ));
    }

}

<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Exercise;

class ExerciseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'Nom : '))
            ->add('type', ChoiceType::class,
                array(
                'label' => 'Groupe musculaire : ',
                'choices' => array(
                    Exercise::PECTORALS => Exercise::PECTORALS,
                    Exercise::BACK => Exercise::BACK,
                    Exercise::SHOULDERS => Exercise::SHOULDERS,
                    Exercise::THIGHS => Exercise::THIGHS,
                    Exercise::SPINAL => Exercise::SPINAL,
                    Exercise::BICEPS => Exercise::BICEPS,
                    Exercise::TRICEPS => Exercise::TRICEPS,
                    Exercise::SHEATING => Exercise::SHEATING,
                    Exercise::OTHER => Exercise::OTHER,
            )))
            ->add('unit', null, array('label' => 'Unité : '))
            ->add('description', null, array('label' => 'Description : '))
            ->add('reference', ChoiceType::class,
                array(
                'label' => 'Référence : ',
                'choices' => array(
                    'Oui' => true,
                    'NON' => false,
                ), 'required' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Exercise'
        ));
    }
}

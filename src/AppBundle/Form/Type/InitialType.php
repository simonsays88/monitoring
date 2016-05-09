<?php

// src/AppBundle/Form/Type/InitialType.php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class InitialType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('firstname', null, array('required' => true))
                ->add('lastname', null, array('required' => true))
                ->add('address', null, array('required' => true))
                ->add('zipCode', null, array('required' => true))
                ->add('city', null, array('required' => true))
                ->add('phoneMobile', null, array('required' => true))
                ->add('birthday', DateType::class,
                    array('widget' => 'choice',
                    'format' => 'dMy',
                    'view_timezone' => "Europe/Paris",
                    'years' => range(date('Y') - 90, date('Y') - 15)
                    ))
                ->add('job', null, array('required' => true))
                ->add('exercises', null, array('required' => true))
                ->add('practiceLocation', null, array('required' => true))
                ->add('health', null, array('required' => true))
                ->add('treatment', null, array('required' => true))
                ->add('smoker', null, array('required' => true))
                ->add('objectives', ChoiceType::class, array(
                    'choices' => array(
                        'Prise de masse musculaire' => "masse",
                        'Sèche / perte de poids' => "seche",
                        'Ré-équilibrage alimentaire' => "alimentaire",
                        'Remise en forme' => "forme"
            )))
                ->add('objectivesDetail', null, array('required' => true))
                ->add('height', null, array('required' => true))
                ->add('weight', null, array('required' => true))
                ->add('imc', null, array('required' => true))
                ->add('shoulders', null, array('required' => true))
                ->add('pectorals', null, array('required' => true))
                ->add('arms', null, array('required' => true))
                ->add('hipSize', null, array('required' => true))
                ->add('thighs', null, array('required' => true))
                ->add('source', null, array('required' => true))
                ->add('attention', null, array('required' => true))
                ->add('preferences', null, array('required' => true))
                ->add('drinking', null, array('required' => true))
                ->add('dietarySupplement', null, array('required' => true))
                ->add('trainingTime', null, array('required' => true))
                ->add('allergy', null, array('required' => true))
                ->add('timeFoodOne', null, array('required' => true))
                ->add('foodOne', null, array('required' => true))
                ->add('timeFoodTwo', null, array('required' => true))
                ->add('foodTwo', null, array('required' => true))
                ->add('timeFoodThree', null, array('required' => true))
                ->add('foodThree', null, array('required' => true))
                ->add('timeFoodFour', null, array('required' => false))
                ->add('foodFour', null, array('required' => false))
                ->add('timeFoodFive', null, array('required' => false))
                ->add('foodFive', null, array('required' => false))
                ->add('timeFoodSix', null, array('required' => false))
                ->add('foodSix', null, array('required' => false))
                ->add('note', null, array('required' => true))
                ->add('homemadeFood', ChoiceType::class, array(
                    'choices'  => array(
                    'Oui' => true,
                    'NON' => false,
                    ),'required' => true
                ))
                ->add('restaurant', null, array('required' => true))
                ->add('photoFront', FileType::class, array('data_class' => null, 'required' => is_null($builder->getData()->getPhotoFront())))
                ->add('photoSide', FileType::class, array('data_class' => null, 'required' => is_null($builder->getData()->getPhotoSide())))
                ->add('photoBack', FileType::class, array('data_class' => null, 'required' => is_null($builder->getData()->getPhotoBack())))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Initial'
        ));
    }

}

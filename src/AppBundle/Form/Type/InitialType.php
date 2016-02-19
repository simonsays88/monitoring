<?php
// src/AppBundle/Form/Type/InitialType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InitialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('required' => true))
            ->add('address', null, array('required' => true))
            ->add('zipCode', null, array('required' => true))
            ->add('phoneMobile', null, array('required' => true))
            ->add('email', null, array('required' => true))
            ->add('birthday', null, array('required' => true))
            ->add('job', null, array('required' => true))
            ->add('exercises', null, array('required' => true))
            ->add('health', null, array('required' => true))
            ->add('treatment', null, array('required' => true))
            ->add('smoker', null, array('required' => true))
            ->add('height')
            ->add('fat')
            ->add('weight')
            ->add('shoulders')
            ->add('pectorals')
            ->add('arms')
            ->add('hipSize')
            ->add('thighs')
            ->add('source')
            ->add('attention')
            ->add('preferences')
            ->add('drinking')
            ->add('dietarySupplement')
            ->add('trainingTime')
            ->add('diet')
            ->add('note')
            ->add('homemadeFood')
            ->add('restaurant')
            ->add('photoFront')
            ->add('photoSide')
            ->add('photoBack')
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Initial'
        ));
    }
}
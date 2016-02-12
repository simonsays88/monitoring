<?php
// src/AppBundle/Form/Type/MonitoringType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MonitoringType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('job')
            ->add('address')
            ->add('zipCode')
            ->add('phoneMobile')
            ->add('email')
            ->add('birthday')
            ->add('exercises')
            ->add('health')
            ->add('treatment')
            ->add('smoker')
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
}
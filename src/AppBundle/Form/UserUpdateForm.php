<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/20/2016
 * Time: 3:39 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserUpdateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name_surname', TextType::class, array(
            'label'=>'Vardas Pavardė'
        ))
        ->add('email', EmailType::class, array(
            'label'=>'El.paštas'
        ))
        ->add('phone_number', TextType::class, array(
            'label'=>'Telefono numeris'
        ))
        ->add('submit', SubmitType::class, array(
            'label'=>'Atnaujinti'
        ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\UserUpdateVar'
        ));
    }

}
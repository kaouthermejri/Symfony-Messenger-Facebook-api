<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/13/2016
 * Time: 12:50 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginForm extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder->add('email', TextType::class, array(
        'label'=> 'El.paštas'
    ))->add('password', PasswordType::class, array(
        'label'=>'Slaptažodis'
    ))->add('login', SubmitType::class, array(
        'label'=> 'Prisijungti'
    ));


   // parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
}

public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(array(
        'data_class'=> 'AppBundle\Entity\RegisterUserVariables'
    ));
 //   parent::configureOptions($resolver); // TODO: Change the autogenerated stub
}

}
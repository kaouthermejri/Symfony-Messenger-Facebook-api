<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/14/2016
 * Time: 1:08 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', RepeatedType::class,array(
            'type'=>PasswordType::class,
            'invalid_message' => 'Slaptažodžių laukai turi sutapti.',
            'options' => array('attr' => array('class' => 'password-field')),
            'required' => true,
            'first_options'=> array('label'=>'Slaptažodis'),
            'second_options'=> array('label'=>'Pakartoti Slaptažodį'),
        ))->add('submit', SubmitType::class,array(
            'label'=>'Pakeisti slaptažodį'
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\DatabaseUserVariables'
        ));
    }
}
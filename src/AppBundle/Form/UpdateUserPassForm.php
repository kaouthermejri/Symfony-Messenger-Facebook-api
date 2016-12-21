<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/21/2016
 * Time: 10:59 AM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateUserPassForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->add('oldPassword', PasswordType::class,array(
           'label'=>'Dabartinis slaptažodis',
           'required'=>true
       ))
       ->add('newPassword', RepeatedType::class,array(
           'type'=>PasswordType::class,
           'invalid_message' => 'Slaptažodžių laukai turi sutapti.',
           'options' => array('attr' => array('class' => 'password-field')),
           'required' => true,
           'first_options'  => array('label' => 'Naujas Slaptažodis'),
           'second_options' => array('label' => 'Pakartoti Naują Slaptažodį'),
       ))
       ->add('submit', SubmitType::class,array(
           'label'=>'Atnaujinti'
       ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefaults(array(
      'data_class'=>'AppBundle\Entity\UpdateUserPass'));
    }

}
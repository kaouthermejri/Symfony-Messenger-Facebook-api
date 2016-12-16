<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/14/2016
 * Time: 11:10 AM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RememberPasswordForm extends  AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->add('email', EmailType::class, array(
           'label'=> 'El.paštas'
       ))->add('send', SubmitType::class, array(
           'label'=>'Priminti'
       ));
    }
 public function configureOptions(OptionsResolver $resolver)
 {
     $resolver->setDefaults(array(
         'data_class'=> 'AppBundle\Entity\RememberVariables'
     ));
 }
}
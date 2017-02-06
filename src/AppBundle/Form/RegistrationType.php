<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 1/11/2017
 * Time: 2:45 PM
 */

namespace AppBundle\Form;



use FOS\MessageBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('phone_number')
        ->add('temporaryImage',null,array('data'=>'user-default.png'));


    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}
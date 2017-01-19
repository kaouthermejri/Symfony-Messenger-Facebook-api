<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 1/2/2017
 * Time: 11:41 AM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AdminUserEditForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username',TextType::class,array(
            'label'=>'Vardas Pavardė',
            'required'=>false
        ))->add('email', EmailType::class,array(
            'label'=>'El. Paštas',
            'required'=>false
        ))->add('phone_number',TextType::class,array(
            'label'=>'Telefono Numeris',
            'required'=>false
        ))->add('category',ChoiceType::class,array(
            'choices'=> array(
                'Jaunuolis'=>'Jaunuolis',
                'Senjoras'=>'Senjoras'
            ),
            'required'=>false
        ))->add('password',PasswordType::class,array(
            'label'=>'Naujas Slaptažodis',
            'required'=>false
        ))->add('image',FileType::class,array(
            'label'=>'Nuotrauka'
        ,'required'=>false
        ))->add('submit',SubmitType::class,array(
            'label'=>'Išsaugoti'
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\AdminEditUser'
        ));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/30/2016
 * Time: 11:08 AM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminUserSearch extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', SearchType::class,array(
            'label'=>'Vardas Pavardė'
        ))->add('email', SearchType::class,array(
            'label'=>'El. Paštas'
        ))->add('created',SearchType::class,array(
            'label'=>'Registracijos data'
        ))->add('category',SearchType::class,array(
            'label'=>'Grupė'
        ))->add('submit',SubmitType::class,array(
            'label'=>'Ieškoti'
        ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\AdminUserSearchVar'
        ));
    }

}
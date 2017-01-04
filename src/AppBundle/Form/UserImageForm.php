<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/21/2016
 * Time: 12:13 PM
 */

namespace AppBundle\Form;


use Doctrine\Common\Util\ClassUtils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserImageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->add('image', FileType::class,array(
           'label'=>'Nuotrauka'
       ))
           ->add('submit', SubmitType::class,array(
               'label'=>'Atnaujinti'
           ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults(array(
           'data_class'=>'AppBundle\Entity\UserImage'
       ));
    }
}
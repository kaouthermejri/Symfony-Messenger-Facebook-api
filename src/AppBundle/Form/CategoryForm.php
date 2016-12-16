<?php
/**
 * Created by PhpStorm.
 * User: Egidijus
 * Date: 12/15/2016
 * Time: 12:11 PM
 */

namespace AppBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class CategoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('category')
        ->add('submit', SubmitType::class)
        ->add('senjoras', ButtonType::class, array(
                'attr' => array('value' => 'Senjoras', 'name'=>'Submit'),
            ))
            ->add('jaunuolis', ButtonType::class, array(
                'attr'=>array('value'=>'Jaunuolis', 'name'=>'submit')
            ));

    }
public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(array(
        'data_class'=>'AppBundle\Entity\DatabaseUserVariables'
    ));
}

}
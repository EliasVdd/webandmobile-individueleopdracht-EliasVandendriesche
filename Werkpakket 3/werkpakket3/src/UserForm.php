<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 19/10/2018
 * Time: 10:17
 */

namespace App;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('userName', 'text');
        $builder->add('plainPassword', 'repeated', array(
            'first_name'  => 'password',
            'second_name' => 'confirm',
            'type'        => 'password',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user';
    }

}
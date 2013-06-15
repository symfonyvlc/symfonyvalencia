<?php

namespace SfVlc\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Nombre',
            ))
            ->add('email', 'email', array(
                'label' => 'Email',
            ))
            ->add('message', 'textarea', array(
                'label' => 'Mensaje',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SfVlc\MainBundle\Form\Model\Contact',
        ));
    }

    public function getName()
    {
        return 'contact';
    }
}

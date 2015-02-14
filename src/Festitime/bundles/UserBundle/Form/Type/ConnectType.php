<?php

namespace Festitime\bundles\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConnectType extends AbstractType
{
    /**
    * {@inheritdoc}
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pseudo', 'text');
        $builder->add('password', 'password');
    }

    /**
    * {@inheritdoc}
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Festitime\DatabaseBundle\Document\User'
        ));
    }

    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return 'connect';
    }
}

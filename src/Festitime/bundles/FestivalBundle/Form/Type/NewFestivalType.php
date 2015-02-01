<?php

namespace Festitime\bundles\FestivalBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewFestivalType extends AbstractType
{
    /**
    * {@inheritdoc}
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'required' => true,
            'label' => 'Nom',
        ));
        $builder->add('description', 'text', array(
            'required' => true,
            'label' => 'Description',
        ));
        $builder->add('type', 'choice', array(
            'choices' => array(
                'electro' => 'Electro', 
                'rock' => 'Rock',
                'pop' => 'Pop',
                'hiphop' => 'Hip Hop',
                'rap' => 'Rap',
                'reggae' => 'Reggae',
                'ragga' => 'Ragga',
                'jazz' => 'Jazz',
                'dark' => 'Dark',
                'metal' => 'Metal',
                'punk' => 'Punk',
            ),
            'expanded' => true,
            'multiple' => true,
            'required' => true,
            'label' => 'Genre(s)',
        ));
        $builder->add('attachment', 'file'array(
            'label' => 'Image',
        ));
        $builder->add('startDate', 'date', array(
            'input' => 'timestamp',
            'widget' => 'choice',
            'format' => 'yyyy-MM-dd',
            'required' => true,
            'label' => 'Date de début',
        ));
        $builder->add('endtDate', 'date', array(
            'input' => 'timestamp',
            'widget' => 'choice',
            'format' => 'yyyy-MM-dd',
            'required' => true,
            'label' => 'Date de fin',
        ));
        $builder->add('city', 'text', array(
            'required' => true,
            'label' => 'Ville',
        ));
        //Region
        $builder->add('country', 'country', array(
            'preferred_choices' => array('FR'),
            'required' => true,
            'label' => 'Pays',
        ));
        $builder->add('price', 'money', array(
            'currency' => 'EUR',
            'required' => true,
            'label' => 'Prix',
        ));
    }

    /**
    * {@inheritdoc}
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Festitime\bundles\FestivalBundle\Document\Festival'
        ));
    }

    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return 'newFestival';
    }
}

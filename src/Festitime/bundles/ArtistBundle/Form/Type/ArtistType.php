<?php

namespace Festitime\bundles\ArtistBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArtistType extends AbstractType
{
    /**
    * {@inheritdoc}
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pseudo', 'text', array(
            'required' => false,
            'label'    => 'artists.labels.pseudo',
        ));
        $builder->add('firstname', 'text', array(
            'required' => true,
            'label'    => 'artists.labels.firstname',
        ));
        $builder->add('lastname', 'text', array(
            'required' => true,
            'label'    => 'artists.labels.lastname',
        ));
        $builder->add('description', 'textarea', array(
            'required' => true,
            'label'    => 'artists.labels.description',
        ));
        $builder->add('type', 'choice', array(
            'choices'  => array(
                'electro' => 'Electro',
                'rock'    => 'Rock',
                'pop'     => 'Pop',
                'hip-hop' => 'Hip Hop',
                'rap'     => 'Rap'
            ),
            'multiple' => true,
            'required' => true,
            'label'    => 'artists.labels.type'
        ));

        $builder->add('picture', 'text', array(
            'required' => true,
            'label'    => 'artists.labels.picture'
        ));
    }

    /**
    * {@inheritdoc}
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Festitime\DatabaseBundle\Document\Artist',
            'csrf_protection' => false
        ));
    }

    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return 'artist';
    }
}

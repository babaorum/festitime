<?php

namespace Festitime\bundles\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    /**
    * {@inheritdoc}
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //pseudo
        $builder->add('pseudo', 'text', array(
            'required' => true,
            'label' => 'Pseudonyme',
        ));
        //email
        $builder->add('email', 'repeated', array(
            'type' => 'email',
            'options' => array('required' => true),
            'invalid_message' => 'Veuillez renseigner une adresse email valide.',
            'first_options'  => array('label' => 'Email'),
            'second_options' => array('label' => 'Confirmation de l\'email'),
        ));
        //mot de passe
        $builder->add('password', 'repeated', array(
            'type' => 'password',
            'options' => array('required' => true),
            'invalid_message' => 'Veuillez renseigner deux fois un mot de passe de %num% caactères.',
            'invalid_message_parameters' => array('%num%' => 8),
            'first_options'  => array('label' => 'Mot de passe'),
            'second_options' => array('label' => 'Confirmation du mot de passe'),
        ));
        //naissance
        $builder->add('birthdate', 'birthday', array(
            'input' => 'timestamp',
            'widget' => 'choice',
            'format' => 'yyyy-MM-dd',
            'required' => true,
            'label' => 'Date de naissance',
        ));
        //sexe
        $builder->add('gender', 'choice', array(
            'choices' => array('m' => 'Masculin', 'f' => 'Féminin'),
            'expanded' => true,
            'required' => true,
            'label' => 'Sexe',
        ));
        //prenom
        $builder->add('firstname', 'text', array(
            'required' => true,
            'label' => 'Prénom',
        ));
        //nom
        $builder->add('name', 'text', array(
            'required' => true,
            'label' => 'Nom de famille',
        ));
        //adresse
        $builder->add('address', 'text', array(
            'required' => true,
            'label' => 'Adresse postale',
        ));
        //ville
        $builder->add('city', 'text', array(
            'required' => true,
            'label' => 'Ville',
        ));
        //code postal
        $builder->add('zipcode', 'text', array(
            'required' => true,
            'label' => 'Code postal',
        ));
        //pays
        $builder->add('country', 'country', array(
            'preferred_choices' => array('FR'),
            'required' => true,
            'label' => 'Pays',
        ));
    }

    /**
    * {@inheritdoc}
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Festitime\bundles\UserBundle\Document\User',
            'csrf_protection' => false
        ));
    }

    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return 'register';
    }
}

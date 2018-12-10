<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('name', TextType::class)
            ->add('username', TextType::class)
            ->add('mail', EmailType::class)
            ->add('locations', TextType::class)
            ->add('password', RepeatedType::class, [
                'type'              => PasswordType::class,
                'first_options'     => ['label' => 'password'],
                'second_options'    => ['label' => 'repeatPassword'],
                'invalid_message'   => 'Mot de passe non conforme à celui taper avant'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}

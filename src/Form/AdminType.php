<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder2, array $options)
    {
        $builder2
            ->add('name', TextType::class, ['label' => false,'required' => false])
            ->add('username', TextType::class, ['label' => false,'required' => false])
            ->add('mail', EmailType::class, ['label' => false,'required' => false])
            ->add('locations', TextType::class, ['label' => false,'required' => false])
            ->add('password', RepeatedType::class, [
                'type'              => PasswordType::class,
                'first_options'     => ['label' => 'Pour confirmer vos modifications tapez votre nouveau mot de passe ou l\'ancien'],
                'second_options'    => ['label' => 'Confirmez votre mot de passe'],
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

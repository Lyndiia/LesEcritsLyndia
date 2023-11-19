<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Info;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email'
            , EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Modifier mon Email : ',
                'label_attr' => [
                    'class' => 'label' 
                ],])
            ->add('plainPassword', TextType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Modifier mon mot de passe : ',
                'label_attr' => [
                    'class' => 'label' 
                ],
            ])
            ->add('user_name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Modifier mon Nom et Prénom : ',
                'label_attr' => [
                    'class' => 'label' 
                ],])
            ->add('user_pseudo', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Modifier mon pseudo : ',
                'label_attr' => [
                    'class' => 'label' 
                ],])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            
        ]);
    }
}


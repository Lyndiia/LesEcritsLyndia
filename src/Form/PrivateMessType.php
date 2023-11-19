<?php

namespace App\Form;

use App\Entity\PrivateMess;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrivateMessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mess_title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Titre du message : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
            ->add('mess_content', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; height: 30vh; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Message : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
            ->add('recipient', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'user_pseudo',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Destinataire : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 

            ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn'
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PrivateMess::class,
        ]);
    }
}

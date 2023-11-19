<?php

namespace App\Form;

use App\Entity\Story;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('story_title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Titre de l\'histoire : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
            ->add('story_genre', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Genre de l\'article : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
            ->add('story_pic', FileType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Image (JPG, JPEG, PNG file)',
                'mapped' => false,
                'required' => false,
                'label_attr' => [
                    'class' => 'label' 
                ],
                ])
            ->add('story_desc', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; height: 10vh; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Description : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
            ->add('story_content', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; height: 30vh; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Contenu de l\'histoire : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Story::class,
        ]);
    }
}

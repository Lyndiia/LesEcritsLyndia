<?php

namespace App\Form;

use App\Entity\Chapter;
use App\Entity\Story;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('chap_title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Titre du chapitre: ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
            ->add('chap_content', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; height: 30vh; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Contenu du chapitre : ',
                'label_attr' => [
                    'class' => 'label' 
                ],  ])
            ->add('story', EntityType::class, [
                'class' => Story::class,
                'choice_label' => 'story_title',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Histoire à laquelle appartient le chapitre : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chapter::class,
        ]);
    }
}

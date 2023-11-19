<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Story;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('art_title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Titre de l\'article : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
            ->add('art_desc', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; height: 10vh; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Description : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
            ->add('art_pic', FileType::class, [
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
            ->add('art_content',  TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; height: 30vh; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Contenu de l\'article : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
            ->add('tag', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'resize: none; width: 90%; margin: 0 auto;'
                ],
                'label' => 'Tag de l\'article : ',
                'label_attr' => [
                    'class' => 'label' 
                ], 
            ])
            ->add('story', EntityType::class, [
                'class' => Story::class,
                'choice_label' => 'story_title',
                'multiple' => true,
                'expanded' => true, 
                'label' => 'Histoires associées à l\'article : ',
                'label_attr' => [
                    'class' => 'label',
                ],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

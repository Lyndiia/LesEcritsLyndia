<?php

namespace App\Form;

use App\Entity\Writing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class Writing1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('writ_content', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Entrez votre text ici : ',
                'label_attr' => [
                    'class' => 'label' 
                ],  ])
            ->add('writ_attachment', FileType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Fichier',
                'required' => false, 
                'label_attr' => [
                    'class' => 'label' 
                ],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Writing::class,
        ]);
    }
}

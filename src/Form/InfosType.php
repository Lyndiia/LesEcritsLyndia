<?php

namespace App\Form;

use App\Entity\Info;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('info_genre', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mon genre préféré : ',
                'label_attr' => [
                    'class' => 'label' 
                ],])
            ->add('info_type', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mon type préféré : ',
                'label_attr' => [
                    'class' => 'label' 
                ],
                ])
            ->add('info_pic', FileType::class, [
                'label' => 'Image (JPG, JPEG, PNG file)',
                'mapped' => false,
                'required' => false,
                'label_attr' => [
                    'class' => 'label' 
                ],
            ])
            ->add('info_desc', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Ma description : ',
                'label_attr' => [
                    'class' => 'label' 
                ],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Info::class,
        ]);
    }
    
}

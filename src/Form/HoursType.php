<?php

namespace App\Form;

use App\Entity\Hours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class HoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('dayWeek', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Jour de la semaine',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
        ])
        ->add('morning_open_hours', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Horaire d\'ouverture du matin',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
        ])
        ->add('morning_close_hours', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Horaire de fermeture du matin',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
        ])

        ->add('afternoon_open_hours', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Horaire d\'ouverture de l\'après-midi',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
        ])
        ->add('afternoon_close_hours', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Horaire de fermeture de l\'après-midi',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
         ])

        // ->add('is_open', CheckboxType::class, [
        //     'attr' => [
        //         'class' => 'form-check-input mt-4'
        //     ],
        //     'label'    => 'indiqué comme fermé',
        //     'required' => false,
        //     'label_attr' => [
        //         'class' => 'form-check-label mt-4',
        //         'value' => 'Oui'
        //     ]
        // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hours::class,
        ]);
    }
}

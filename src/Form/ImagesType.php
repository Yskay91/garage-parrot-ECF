<?php

namespace App\Form;

use App\Entity\Cars;
use App\Entity\Images;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageName')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            // ->add('car', EntityType::class, [
            //     'class' => Cars::class,
            //     'choice_label' => 'fullname',
            //     'label' => 'Voiture concernée',
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //     ]
            // ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Images::class,
        ]);
    }
}

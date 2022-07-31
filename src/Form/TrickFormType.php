<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Video;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;


class TrickFormType extends AbstractType
{

    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la figure :',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description :',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('category', EntityType::class, [
                'label' => 'Categorie :',
                'attr' => ['class' => 'form-control'],
                'class' => Category::class,
                'choice_label' => 'Name'
            ])
            ->add('video', CollectionType::class, [
                // each entry in the array will be an "email" field
                'entry_type' => TextType::class,
                'label' => 'Balise embed de la video',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => 0,
                'prototype_options'  => [
                    'label' => 'Url embed de la video :',
                ],
                // these options are passed to each "email" type
                'entry_options' => [
                    'attr' => ['class' => 'form-control'],
                ],
            ])
            ->add('picture', CollectionType::class, [
                'entry_type' => UrlType::class,
                'label' => 'Url de l\'image :',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => 0,
                'prototype_options'  => [
                    'label' => 'Url de la photo :',
                ],
                // these options are passed to each "email" type
                'entry_options' => [
                    'attr' => ['class' => 'form-control'],
                ],
            ]);
    }
}

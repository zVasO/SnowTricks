<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TrickEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Nom de la figure :',
                'empty_data' => '',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('category', EntityType::class, [
                'label' => 'Categorie :',
                'label_attr' => [],
                'attr' => ['class' => 'form-select'],
                'class' => Category::class,
                'choice_label' => 'Name'
            ])
            ->add('video', CollectionType::class, [
                'entry_type' => VideoType::class,
                'allow_add' => true,
                'allow_delete' => true,
                // these options are passed to each "email" type
                'entry_options' => [
                    'attr' => ['class' => 'form-control'],
                ],
            ])
            ->add('picture', CollectionType::class, [
                'entry_type' => PictureType::class,
                'allow_add' => true,
                'allow_delete' => true,
                // these options are passed to each "email" type
                'entry_options' => [
                    'attr' => ['class' => 'form-control'],
                ],
            ]);
    }

}

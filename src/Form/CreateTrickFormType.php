<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;


class CreateTrickFormType extends AbstractType
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
            ->add('video', UrlType::class, [
                'label' => 'Lien embed de la vidéo :',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('picture', UrlType::class, [
                'label' => 'Lien de la photo :',
                'attr' => ['class' => 'form-control'],
            ]);
    }
}

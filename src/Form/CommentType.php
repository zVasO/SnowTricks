<?php

namespace App\Form;

use App\Model\MessageEntityModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Content', TextType::class, [
                'attr' => ['class' => 'form-control',
                    'id' => "message",
                    'placeholder' => "Votre message"],
            ])
            ->add('submit', SubmitType::class,[
                'attr' => ['class' => 'form-control btn btn-primary',
                    'value' => "Envoyer",
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MessageEntityModel::class,
            'attr' => ['class' => 'w-100 d-flex gap-3']
        ]);
    }
}

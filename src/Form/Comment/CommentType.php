<?php

namespace App\Form\Comment;

use App\Entity\Comment\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // Title
            ->add('title', TextType::class, [
//                'label' => "Entrer le titre du commentaire",

                'attr' => [
                    'placeholder' => "Saisissez le titre de votre commentaire"
                ],

                'help' => "Champ obligatoire",

                'constraints' => [
                    new NotBlank([
                        'message' => "Le champ est obligatoire"
                    ])
                ]
            ])

            // CommentText
            ->add('commentText')

            // CreationDate
            ->add('creationDate')

            // UpdateDate
            ->add('updateDate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}

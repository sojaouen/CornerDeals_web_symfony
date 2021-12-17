<?php

namespace App\Form\Category;

use App\Entity\Category\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // Name
            ->add('name', TextType::class, [
//                'label' => "Entrer le nom de la catégorie",

                'attr' => [
                    'placeholder' => "Entrer le nom de la catégorie"
                ],

                'help' => "Champ obligatoire",

                'constraints' => [
                    new NotBlank([
                        'message' => "Le champ est obligatoire"
                    ])
                ]
            ])

            // Descriptioon
            ->add('description')

            // Color
            ->add('color')

            // Illustration
            ->add('illustration')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}

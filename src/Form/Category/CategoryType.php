<?php

namespace App\Form\Category;

use App\Entity\Category\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // Name
            ->add('name', TextType::class, [
                'label' => "Nom",
                'required' => true,
                'attr' => [
                    'placeholder' => "Veuillez saisir le nom de la catégorie"
                ],

                'constraints' => [
                    new NotBlank([
                        'message' => "Le nom de la catégorie est obligatoire",
                        'groups' => "category"
                    ]),
                ]
            ])

            // Description
            ->add('description', TextareaType::class, [
                'label' => "Description",

                'constraints' => [
                    new NotBlank([
                        'message' => "Une description est obligatoire",
                        'groups' => "category"
                    ]),
                ]
            ])

            // Color
            ->add('color', ColorType::class, [
                'label' => "Couleur"
            ])

            // Illustration
            ->add('illustration', FileType::class, [
                'data_class' => null,
                'label' => "Image de la catégorie",
                'mapped' => true, // signifie que le champ est associé à une propriété
                'required' => true,
                'attr' => [
                    'class' => 'dropify'
                ],

                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg'
                        ],
                        'mimeTypesMessage' => "Extensions acceptées : jpg/jpeg/png"
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
            'validation_groups' => ['category']
        ]);
    }


}

<?php

namespace App\Form\DiscountCode;

use App\Entity\DiscountCode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class DiscountCodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // Title
            ->add('title',TextType::class, [
                'label' => "Titre",
                'required' => true,
                'attr' => [
                    'placeholder' => "Veuillez saisir le titre"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Le titre est obligatoire"
                    ])
                ],
            ])

        // Code
            ->add('code',TextType::class, [
            'label' => "Code de réduction",
            'required' => true,
            'attr' => [
                'placeholder' => "Veuillez saisir le code"
            ],
            'constraints' => [
                new NotBlank([
                    'message' => "Le code de réduction est obligatoire"
                ])
            ],
        ])

        // Description
            ->add('description', TextareaType::class, [
                'label' => "Description",
                'required' => false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DiscountCode::class,
        ]);
    }
}

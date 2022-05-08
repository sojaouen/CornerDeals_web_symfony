<?php

namespace App\Form\Product;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // Name
            ->add('name', TextType::class, [
                'label' => "Nom",
                'required' => true,
                'attr' => [
                    'placeholder' => "Veuillez saisir le nom du produit"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Le nom du produit est obligatoire"
                    ])
                ],
            ])

            // Description
            ->add('description', TextareaType::class, [
                'label' => "Description",
                'required' => false
            ])

            // Product Categories
            ->add('category', EntityType::class,[
                // On base le champ EntityType sur l'entité Category
                'class' => Category::class,
                'label' => "Catégorie",

                'choice_label' => "name"
            ])

            // illustration
            ->add('illustration', UrlType::class,[
                'label' => "Photo du produit",
                'required' => true,
                'attr' => [
                    'placeholder' => "Insérer ici l'Url de l'image du produit"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

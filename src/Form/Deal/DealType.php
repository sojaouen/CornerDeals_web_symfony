<?php

namespace App\Form\Deal;

use App\Entity\Category;
use App\Entity\Deal;
use App\Entity\Merchant;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class DealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // Title
            ->add('title', TextType::class, [
                'label' => "Titre",
                'required' => true,
                'attr' => [
                    'placeholder' => "Veuillez saisir le titre du deal"
                ],

                'constraints' => [
                    new NotBlank([
                        'message' => "Le titre est obligatoire"
                    ])
                ]
            ])

            // Description
            ->add('description', TextareaType::class, [
                'label' => "Description",
                'required' => false,
                'attr'=> [
                    'rows' => 5
                ],
                'help' => 'Entre 20 et 600 caractères'
            ])

            // Catégorie
            ->add('category', EntityType::class, [
                // On base le champ EntityType sur l'entité Category
                'class' => Category::class,
                // On classe les catégories par ordre alphabétique
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'label' => "Catégorie",


                'choice_label' => "name"
            ])
            // Merchant
            ->add('merchant', EntityType::class, [
                // On base le champ EntityType sur l'entité Merchant
                'class' => Merchant::class,
                // On classe les boutiques par ordre alphabétique
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('b')
                        ->orderBy('b.name', 'ASC');
                },
                'label' => "Boutique",
                'expanded' => true,

                'choice_label' => "name"
            ])

            // Illustration
            ->add('illustration', FileType::class, [
                'data_class' => null,
                'label' => "Image du deal",
                'mapped' => false, // signifie que le champ est associé à une propriété
                'required' => true,
                'attr' => [
                    'class' => 'dropify'
                ],
                'help' => "Extensions en .jpg, .jpeg ou .png / taille max autorisée de 2Mo",

                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg'
                        ],
                        'mimeTypesMessage' => "Extensions acceptées : jpg/jpeg/png",
                    ])
                ]
            ])

            // URL
            ->add('url', TextType::class, [
                'label' => "URL du deal",
                'required' => true,
                'invalid_message' => "L'adresse URL saisie n'est pas valide",
                'attr' => [
                    'placeholder' => "Veuillez copier ici l'adresse url du deal"
                ],
            ])
            // crossedOutPrice
            ->add('crossedOutPrice', MoneyType::class, [
                'label' => "Prix avant réduction",
                'required' => false,
                'invalid_message' => "Le prix n'est pas valide",
                'attr' => [
                    'placeholder' => "Le prix avant la réduction"

                ]
            ])

            // dealPrice
            ->add('dealPrice', MoneyType::class, [
                'label' => "Prix",
                'required' => true,
                'invalid_message' => "Le prix n'est pas valide",
                'attr' => [
                    'placeholder' => "Le prix après la réduction"
                ]
            ])
            // discount
            ->add('discount', NumberType::class, [
                'label' => "Montant de la réduction",
                'required' => true
            ])

            // discountType
            ->add('discountType', ChoiceType::class, [
                'label' => "Type de réduction :",
                'choices' => [
                    'En chiffre' => 'nbr',
                    'En pourcentage' => '%',
                ],
                'expanded' => true,
            ])

            // discountCode
            ->add('discountCode', TextType::class, [
                'label' => "Code Promo",
                'required' => false,
                'attr' => [
                    'placeholder' => "Veuillez saisir le code promo du deal"
                ]
            ])

            // currencyType
            ->add('currencyType', CurrencyType::class, [
                'label' => "Devise",
                'required' => true,
                'attr' => [
                    'placeholder' => "Euro"
                ]
            ])

            // startAt
            ->add('startAt', DateType::class, [
                'label' => "Date du début de l'offre",
                'invalid_message' => "La date de début n'est pas valide",
                'widget' => "single_text",
                ])

            // endAt
            ->add('endAt', DateType::class, [
                'label' => "Date de fin de l'offre",
                'invalid_message' => "La date de fin n'est pas valide",
                'widget' => "single_text",
            ])

            // shippingCost
            ->add('shippingCost', NumberType::class, [
                'label' => "Frais d'envoi",
                'required' => false,
                'attr' => [
                    'placeholder' => "Montant des frais d'expédition"
                ]
            ])

            // isFreeShipping
            ->add('isFreeShipping', ChoiceType::class, [
                'label' => "Frais d'envoi offerts",
                'required' => false,
                'choices' => [
                    'Je ne sais pas' => null,
                    'Oui' => true,
                    'Non' => false
                ]
            ])

            // isLocal
            ->add('isLocal', ChoiceType::class, [
                'label' => "Offre locale",
                'required' => false,
                'choices' => [
                    'Je ne sais pas' => null,
                    'Oui' => true,
                    'Non' => false
                ]
            ])

            // localities
            ->add('localities', TextType::class, [
                'label' => "Ville",
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Deal::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}

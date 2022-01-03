<?php

namespace App\Form\Deal;

use App\Entity\Deal;
use App\Entity\Merchant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class DealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // Title
            ->add('title', TextType::class,[
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
                'required' => false
            ])

            // Merchant
            ->add('merchant', EntityType::class,[
                // On base le champ EntityType sur l'entité Merchant
                'class' => Merchant::class,
                'label' => "Boutique",

                'choice_label' => "name"
            ])

            // URL
            ->add('url', TextType::class,[
                'label' => "URL du deal",
                'required' => true,
                'attr' => [
                    'placeholder' => "Veuillez copier ici l'adresse url du deal"
                ],
            ])
            // crossedOutPrice
            ->add('crossedOutPrice', NumberType::class, [
                'label' => "Prix habituel",
                'required' => false,
                'attr' => [
                    'placeholder' => "Le prix avant la réduction"
                ]
            ])

            // dealPrice
            ->add('dealPrice',NumberType::class, [
                'label' => "Prix actuel",
                'required' => true,
                'attr' => [
                    'placeholder' => "Le prix après la réduction"
                ]
            ])
            // discount
            ->add('discount',NumberType::class, [
                'label' => "Montant de la réduction",
                'required' => true
            ])

            // discountType
            -> add('discountType', ChoiceType::class,[
                'label' => "Unité de mesure",
                'choices' => [
                    'Numéraire' => 'nbr',
                    'Pourcentage' => '%',
                ]
            ])

            // discountCode
            ->add('discountCode', TextType::class,[
                'label' => "Code Promo",
                'required' => false,
                'attr' => [
                    'placeholder' => "Veuillez saisir le code promo du deal"
                ]
            ])

            // currencyType
            ->add('currencyType', CurrencyType::class,[
                'label' => "Devise",
                'required' => true,
                'attr' => [
                    'placeholder' => "Euro"
                ]
            ])

            // startAt
            ->add('startAt', DateType::class,[
                'label' => "Date du début de l'offre"
            ])

            // endAt
            ->add('endAt', DateType::class,[
                'label' => "Date de fin de l'offre"
            ])

            // shippingCost
            ->add('shippingCost', NumberType::class,[
                'label' => "Frais d'envoi",
                'required' => false,
                'attr' => [
                    'placeholder' => "Montant des frais d'expédition"
                ]
            ])

            // isFreeShipping
            ->add('isFreeShipping', ChoiceType::class,[
                'label' => "Frais d'envoi offerts",
                'required' => false,
                'choices' => [
                    'Je ne sais pas' => null,
                    'Oui' => true,
                    'Non' => false
                ]
            ])

            // isLocal
            ->add('isLocal', ChoiceType::class,[
                'label' => "Offre locale",
                'required' => false,
                'choices' => [
                    'Je ne sais pas' => null,
                    'Oui' => true,
                    'Non' => false
                ]
            ])

            // localities
            ->add('localities', TextType::class,[
                'label' => "Ville",
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Deal::class,
        ]);
    }
}

<?php

namespace App\Form\Deal;

use App\Entity\Deal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
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
                'label' => "Prix normal",
                'required' => true,
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

            // startAt

            // endAt

            // shippingCost

            // isFreeShipping

            // isLocal

            // localities

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Deal::class,
        ]);
    }
}

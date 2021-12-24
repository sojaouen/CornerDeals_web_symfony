<?php

namespace App\Form\Deal;

use App\Entity\Deal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
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

            // discountUnity
            ->add('discountUnity', PercentType::class, [
                'label' => "Pourcentage de réduction",
                'required' => true
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

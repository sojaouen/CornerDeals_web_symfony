<?php

namespace App\Form\Deal;

use App\Entity\Deal\Deal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('crossedOutPrice')
            ->add('dealPrice')
            ->add('discount')
            ->add('discountUnity')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Deal::class,
        ]);
    }
}

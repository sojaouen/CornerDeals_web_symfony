<?php

namespace App\Form\Address;

use App\Entity\Address\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('streetNumber')
            ->add('streetNumberExtension')
            ->add('streetType')
            ->add('streetName')
            ->add('building')
            ->add('establishment')
            ->add('floor')
            ->add('floorNumber')
            ->add('postalCode')
            ->add('postalCodePrefix')
            ->add('postalCodeSuffix')
            ->add('city')
            ->add('cedex')
            ->add('postBoxCode')
            ->add('locality')
            ->add('adminitrativeAreaLevel1')
            ->add('adminitrativeAreaLevel2')
            ->add('adminitrativeAreaLevel3')
            ->add('adminitrativeAreaLevel4')
            ->add('adminitrativeAreaLevel5')
            ->add('country')
            ->add('latitude')
            ->add('longitude')
            ->add('altitude')
            ->add('isFlat')
            ->add('hasElevator')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}

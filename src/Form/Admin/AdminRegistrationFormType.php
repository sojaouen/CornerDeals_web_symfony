<?php

namespace App\Form\Admin;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')

            // CollectionType: on définit un champ CollectionType car dans la BDD est stocké un array/json
            ->add('roles', CollectionType::class, [
                'label_format' => 'Rôle utilisateur',
                'entry_type' => ChoiceType::class, // On définit le champ comme une liste déroulante
                'entry_options' => [ // on définit les valeur des balises ‹option></option> du sélecteur
                    'choices' => [
                        'Utilisateur' => 'ROLE_USER',
                        'Administrateur' =>'ROLE_ADMIN'
                        // 'Utilisateur'--> contenu de la balise ‹option></option>
                        // 'ROLE_USER' > dans l'attribut value <option value=' ROLE_USER'>Utilisateur</option>
                    ]
                ]
            ])
            ->add('firstname')
            ->add('lastname')
            ->add('birthdate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

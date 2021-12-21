<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Unique;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Définition de la liste des années
        $years = range(date('Y') - 100, date('Y') -18);

        // Pour inverser les années dans la liste
        rsort($years);


        $builder

            // Email
            ->add('email', EmailType::class, [
                'label' => "Email",
                'required' => true,
                'attr' => [
                    'placeholder' => "Veuillez saisir votre adresse email"
                ],


                'constraints' => [
                    new NotBlank([
                       'message' => "L'adresse email est obligatoire"
                    ]),
                    new Email([
                        'message' => "L'adresse email n'est pas valide"
                    ]),
                    new Unique([
                        'message' => "L'adresse email est déjà utilisée"
                    ])
                ]
            ])

            // Firstname
            ->add('firstname', TextType::class, [
                'label' => "Prénom",
                'required' => true,
                'attr' => [
                    'placeholder' => "Veuillez saisir votre prénom"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Le prénom est obligatoire"
                    ])
                ],
            ])

            // Lastname
            ->add('lastname', TextType::class, [
                'label' => "NOM",
                'required' => true,
                'attr' => [
                    'placeholder' => "Veuillez saisir votre nom"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Le nom est obligatoire"
                    ])
                ],
            ])

            // Birthdate
            ->add('birthdate', BirthdayType::class, [
                'label' => "Date de naissance",
                'required' => true,
                'placeholder' => [
                    'year' => "Année",
                    'month' => "Mois",
                    'day' => "Jour",
                ],
//                Liste des options du champs <select> "Year"
                'years' => $years,

                'constraints' => [
                    new NotBlank([
                        'message' => "La date de naissance est obligatoire"
                    ])
                ],
            ])

            // Agree terms
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les CGU',
                    ]),
                ],
            ])

            // Password
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => "Mot de passe",
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saisissez votre mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

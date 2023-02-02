<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Equipe;
use App\Entity\Licencie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class LicencieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomLicencie', TextType::class, [
                // On rajoute une classe bootstrap
                'attr' => [
                    'class' => 'form-control',
                    // 2 caractères minimum
                    'minlength' => '2',
                    // 50 caractères maximum
                    'maxlength' => '50'
                ],
                // On met le label en français
                'label' => 'Nom',
                // On rajoute des classes bootstrap
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                // On rajoute des contraintes avec Assert comme pour notre entité
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank
                ]
            ])

            ->add('prenomLicencie', TextType::class, [
                // On rajoute une classe bootstrap
                'attr' => [
                    'class' => 'form-control',
                    // 2 caractères minimum
                    'minlength' => '2',
                    // 50 caractères maximum
                    'maxlength' => '50'
                ],
                // On met le label en français
                'label' => 'Prénom',
                // On rajoute des classes bootstrap
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                // On rajoute des contraintes avec Assert comme pour notre entité
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),

                    new Assert\NotBlank
                ]
            ])
            ->add('photoLicencie')
            ->add(
                'dateNaissance',
                BirthdayType::class,
                [
                    // On rajoute une classe bootstrap
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Date de naissance',
                    // On rajoute des classes bootstrap
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ]
                ]
            )
            ->add('idClub', EntityType::class, [
                'class' => Club::class,
                'choice_label' => 'nomClub',
                'label' => "Choisir un club"

            ])
            ->add('idEquipe', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' => 'nomEquipe',
                'label' => "Choisir une équipe"

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Licencie::class,
        ]);
    }
}
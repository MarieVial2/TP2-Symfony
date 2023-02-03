<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEquipe', TextType::class, [
                // On rajoute une classe bootstrap
                'attr' => [
                    'class' => 'form-control',
                    // 2 caractères minimum
                    'minlength' => '2',
                    // 50 caractères maximum
                    'maxlength' => '50'
                ],
                // On met le label en français
                'label' => 'Nom de l\'équipe',
                // On rajoute des classes bootstrap
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('idClub', EntityType::class, [
                // looks for choices from this entity
                'class' => Club::class,
                'label' => 'Club de l\'équipe',

                // uses the User.username property as the visible option string
                'choice_label' => 'nomClub',

                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
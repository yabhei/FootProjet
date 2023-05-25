<?php

namespace App\Form;

use App\Entity\Team;
use App\Form\TeamType;
use App\Entity\Matches;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MatchesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mTeam1', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
                //'mapped' => false,
            ])
            ->add('mTeam2', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
                //'mapped' => false,
            ])
            ->add('resultTeam1', NumberType::class, [
                'html5' => true,
                'required' => false,
                'attr' => [

                    'min' => 0,

                ]
            ])
            ->add('resultTeam2', NumberType::class, [
                'html5' => true,
                'required' => false,
                'attr' => [

                    'min' => 0,

                ]
            ])
            ->add('date_match', DateType::class, [
                'widget' => 'single_text'
            ])

            ->add('Create', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matches::class,
        ]);
    }
}
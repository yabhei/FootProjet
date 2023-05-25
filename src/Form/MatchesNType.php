<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\MatchesN;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MatchesNType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder


            ->add('teamN1', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',

            ])
            ->add('teamN2', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',

            ])
            ->add('teamResult1', NumberType::class, [
                'html5' => true,
                'required' => false,
                'attr' => [

                    'min' => 0,

                ]
            ])
            ->add('teamResult2', NumberType::class, [
                'html5' => true,
                'required' => false,
                'attr' => [

                    'min' => 0,

                ]
            ])
            ->add('matchDate', DateType::class, [
                'widget' => 'single_text'
            ])


            ->add('Create', SubmitType::class)


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MatchesN::class,
        ]);
    }
}
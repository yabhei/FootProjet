<?php

namespace App\Form;

// use App\Service\Filter;
use App\Entity\Position;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SearchFormType extends AbstractType
{

    // private $urlGenerator;

    // public function __construct(UrlGeneratorInterface $urlGenerator)
    // {
    //     $this->urlGenerator = $urlGenerator;
    // }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        
        $builder
            
            ->add('position', EntityType::class, [
                'class' => Position::class,
                'choice_label' => 'title',
                // 'attr' =>[ 
                //     'placeholder' => 'Search by position',
                // ]
                
                ])
            ->add('search', SubmitType::class, [
                'label' => 'Search',
            ]);
          
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection'=> false
        ]);
    }
}

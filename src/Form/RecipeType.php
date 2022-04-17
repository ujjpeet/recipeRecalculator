<?php

namespace App\Form;

use App\Entity\Recipe;
use phpDocumentor\Reflection\PseudoTypes\Numeric_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Type a recipe title here...'
                )
            ))
            ->add('serving', IntegerType::class, array(
                'attr' => array(
                    'placeholder' => 'The number of guests is...'
                )
            ))
            ->add('ingredientName', ChoiceType::class, [
                'placeholder' => 'Select one ingredient',
                'choices'  => [
                    'flour' => 'flour',
                    'egg' => 'egg',
                    'milk' => 'milk',
                    'carbonated mineral water' => 'carbonated mineral water',
                    'salt' => 'salt',
                    'oil' => 'oil',
                    'oil for cooking' => 'oil for cooking'
                ]
            ])
            ->add('ingredientAmount', IntegerType::class, array(
                'attr' => array(
                    'placeholder' => 'New amount of this ingredient is...'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}

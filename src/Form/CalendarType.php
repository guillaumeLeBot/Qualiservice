<?php

namespace App\Form;

use App\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('start', DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('end', DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('description', TextType::class, [
                'label' => 'description'
            ])
            ->add('all_day')
            ->add('background_color', ColorType::class)
            ->add('text_color', ColorType::class)
            ->add('pallets_number', IntegerType::class, [
                'label' => 'Nombre de palettes'
            ])
             ->add('building', ChoiceType::class, [
                'label' => 'Batiment',
                'choices' => [
                    'JDC1' => 'JDC1',
                    'JDC2' => 'JDC2',
                    'Royal Canin' => 'Royal Canin',
                    'JDC1/JDC2' => 'JDC1/JDC2',
                    'JDC2/JDC1' => 'JDC2/JDC1',
                    'Quai salle carton' => 'Quai salle carton',
                ],
            ])
            ->add('supplier', ChoiceType::class, [
                'label' => 'Fournisseur',
                'choices' => [
                    'fournisseur1' => 'fournisseur1',
                    'fournisseur2' => 'fournisseur2',
                    'fournisseur3' => 'fournisseur3',
                    'fournisseur4' => 'fournisseur4'
                ]
            ])
            ->add('customer', ChoiceType::class, [
                'label' => 'Client',
                'choices' => [
                    'Loreal' => 'Loreal',
                    'Art beauty' => 'Art beauty',
                    'Alkos' => 'Alkos',
                    'Bodmer & Fils' => 'Bodmer & Fils'
                ]
            ])
            ->add('driver', ChoiceType::class, [
                'label' => 'Cariste',
                'choices' => [
                    'Fabien' => 'Fabien',
                    'Vivien' => 'Vivien',
                    'Robert' => 'Robert',
                ]
            ])
            ->add('comment', TextType::class, [
                'label' => 'commentaire'
            ])
            
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
<?php

namespace App\Form;

use App\Entity\Dock;
use App\Entity\Driver;
use App\Entity\Building;
use App\Entity\Calendar;
use App\Entity\Customer;
use App\Entity\Platform;
use App\Entity\Supplier;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class, [
                'label' => 'Type',
                'choices' => [
                    'Reception' => 'Reception',
                    'Expédition' => 'Expédition',
                    'Envoi Direct' => 'Envoi Direct',
                    'Destruction' => 'Destruction',
                    'Inventaire' => 'Inventaire',
                ],
            ])
            ->add('start', DateTimeType::class, [
                'label' => 'Début rendez vous',
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'hours' => range(8, 18),
                'data' => new \DateTime(),
            ])
            ->add('end', DateTimeType::class, [
                'label' => 'Fin rendez vous',
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'hours' => range(8, 18),
                'data' => new \DateTime(),
            ])
            ->add('come', TimeType::class, [
                'label' => 'Arrivée camion',
            ])
            ->add('deparure', TimeType::class, [
                'label' => 'Départ Camion',
            ])
            ->add('description', ChoiceType::class, [
                'label' => 'Marchandise',
                'required' => true,
                'choices' => [
                    'Réceptioné' => 'Réceptioné',
                    'Refusé' => 'Refusé',
                    'Récept/Contrôlé' => 'Récept/Contrôlé',
                    'Récept/Contrôlée/enregistré' => 'Récept/Contrôlée/enregistré',
                    'Expédié/Contrôlée/enregistré' => 'Expédié/Contrôlée/enregistré',
                    'Préparation/Expédition/Réception' => 'Préparation/Expédition/Réception',
                ],
            ])
            ->add('pallets_number', IntegerType::class, [
                'label' => 'Nbre de palettes'
            ])
            ->add('dock', EntityType::class, [
                'label' => 'Quai',
                'class' => Dock::class,
                'choice_label' => 'name',
            ])
            ->add('building', EntityType::class, [
                'label' => 'Bâtiment',
                'class' => Building::class,
                'choice_label' => 'name',
            ],)
            ->add('supplier', EntityType::class, [
                'label' => 'Fournisseurs',
                'class' => Supplier::class,
                'choice_label' => 'name',
            ])
            ->add('command_number', TextType::class, [
                'label' => 'N° de commande',
                'required' => false
            ])
            ->add('customer', EntityType::class, [
                'label' => 'Clients',
                'class' => Customer::class,
                'choice_label' => 'name',
            ])
            ->add('platform', EntityType::class, [
                'label' => 'Platforme',
                'class' => Platform::class,
                'choice_label' => 'name',
            ])
            ->add('driver', EntityType::class, [
                'label' => 'Cariste',
                'class' => Driver::class,
                'choice_label' => 'name',
            ])
            ->add('comment', TextType::class, [
                'label' => 'Commentaire',
                'required' => false
            ])
            ->add('background_color', TextType::class, [
                'label' => 'couleur de fond',
                'required' => false,
                'data' => '#ff8000'
            ])
            ->add('text_color', TextType::class, [
                'label' => 'couleur du text',
                'required' => false,
                'data' => '#ff8000'
            ]);
     
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
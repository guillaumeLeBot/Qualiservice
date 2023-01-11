<?php

namespace App\Form;

use App\Entity\Driver;
use App\Entity\Building;
use App\Entity\Calendar;
use App\Entity\Customer;
use App\Entity\Supplier;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class, [
                'label' => 'Mode',
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
                'time_widget' => 'single_text',
                'data' => new \DateTime(),
            ])
            ->add('end', DateTimeType::class, [
                'label' => 'Fin rendez vous',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
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
                'label' => 'Nombre de palettes'
            ])
            ->add('building', EntityType::class, [
                'label' => 'Bâtiment',
                'class' => Building::class,
                'choice_label' => 'name',
            ])
            ->add('supplier', EntityType::class, [
                'label' => 'Fournisseurs',
                'class' => Supplier::class,
                'choice_label' => 'name',
            ])
            ->add('customer', EntityType::class, [
                'label' => 'Client',
                'class' => Customer::class,
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
           
     $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            if ($data->getTitle() === 'Reception') {
                $form->get('background_color')->setData('#0000FF');
                $form->get('text_color')->setData('#FFFFFF');
            }
            if($data->getTitle() === 'Expédition'){
                $form->get('background_color')->setData('#FF0000');
                $form->get('text_color')->setData('#FFFFFF');
            }
        });
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
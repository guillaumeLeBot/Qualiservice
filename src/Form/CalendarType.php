<?php

namespace App\Form;

use App\Entity\Drivers;
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
                    'reception' => 'reception',
                    'Expédition' => 'Expédition',
                    'Envoi Direct' => 'Envoi Direct',
                    'Destruction' => 'Destruction',
                    'Inventaire' => 'Inventaire',
                ],
            ])
            ->add('start', DateTimeType::class, [
                'label' => 'Début',
                'date_widget' => 'single_text'
            ])
            ->add('end', DateTimeType::class, [
                'label' => 'Fin',
                'date_widget' => 'single_text',
            ])
            ->add('description', TextType::class, [
                'label' => 'Marchandise',
                'required' => false
            ])
           
            ->add('pallets_number', IntegerType::class, [
                'label' => 'Nombre de palettes'
            ])
            ->add('building', EntityType::class, [
                'class' => Building::class,
                'choice_label' => 'name',
            ])
            ->add('supplier', EntityType::class, [
                'class' => Supplier::class,
                'choice_label' => 'name',
            ])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'choice_label' => 'name',
            ])
            ->add('driver', EntityType::class, [
                'class' => Drivers::class,
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

            if ($data->getTitle() === 'reception') {
                $form->get('background_color')->setData('#0000FF');
                $form->get('text_color')->setData('#FFFFFF');
            }elseif($data->getTitle() === 'Expédition'){
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
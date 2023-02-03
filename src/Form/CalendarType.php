<?php

namespace App\Form;

use App\Entity\Dock;
use App\Entity\Driver;
use App\Entity\Building;
use App\Entity\Calendar;
use App\Entity\Customer;
use App\Entity\Platform;
use App\Entity\Supplier;
use App\Entity\LogisticLeader;
use App\Repository\DriverRepository;
use App\Repository\CustomerRepository;
use App\Repository\PlatformRepository;
use App\Repository\SupplierRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class, [
                'label' => 'Type',
                'choices' => [
                    'Destruction' => 'Destruction',
                    'Envoi Direct' => 'Envoi Direct',
                    'Expédition' => 'Expédition',
                    'Inventaire' => 'Inventaire',
                    'Reception' => 'Reception',
                ],
            ])
            ->add('checked', PasswordType::class, [
                'label' => 'Code cariste',
                'required' => false,
            ])
            ->add('validated_by', PasswordType::class, [
                'label' => 'Code responsable',
                'required' => false,
            ])
            ->add('speed_save', CheckboxType::class, [
                'label' => 'Mofification rapide',
                'required' => false,
                'data' => false
            ])
            ->add('start', DateTimeType::class, [
                'label' => 'Date et heure rendez vous',
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'hours' => range(8, 18),
                'data' => $builder->getData() && $builder->getData()->getStart() ? $builder->getData()->getStart() : new \DateTime(),
            ])
            ->add('end', DateTimeType::class, [
                'label' => 'Date et heure rendez vous',
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'hours' => range(8, 18),
                'data' => $builder->getData() && $builder->getData()->getEnd() ? $builder->getData()->getEnd() : new \DateTime(),
            ])
            
            ->add('come', TimeType::class, [
                'label' => 'Arrivée camion',
                'widget' => 'choice',
                'hours' => range(8, 18),
                'data' => $builder->getData() && $builder->getData()->getCome() ? $builder->getData()->getCome() : new \DateTime(),

            ])
            ->add('deparure', TimeType::class, [
                'label' => 'Départ camion',
                'widget' => 'choice',
                'hours' => range(8, 18),
                'data' => $builder->getData() && $builder->getData()->getDeparure() ? $builder->getData()->getDeparure() : new \DateTime(),

            ])
            ->add('description', ChoiceType::class, [
                'label' => 'Marchandise',
                'required' => true,
                'choices' => [
                    'Expédié/Contrôlée/enregistré' => 'Expédié/Contrôlée/enregistré',
                    'Préparation/Expédition/Réception' => 'Préparation/Expédition/Réception',
                    'Récept/Contrôlé' => 'Récept/Contrôlé',
                    'Récept/Contrôlée/enregistré' => 'Récept/Contrôlée/enregistré',
                    'Réceptioné' => 'Réceptioné',
                    'Refusé' => 'Refusé',
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
                'query_builder' => function (SupplierRepository $er) {
                    return $er->createQueryBuilder('s')
                            ->orderBy('s.name', 'ASC');
                },
            ])
            ->add('command_number', TextType::class, [
                'label' => 'N° de commande',
                'required' => false
            ])
            ->add('customer', EntityType::class, [
                'label' => 'Clients',
                'class' => Customer::class,
                'choice_label' => 'name',
                'query_builder' => function (CustomerRepository $er) {
                    return $er->createQueryBuilder('c')
                            ->orderBy('c.name', 'ASC');
                },
            ])
            ->add('platform', EntityType::class, [
                'label' => 'Platforme',
                'class' => Platform::class,
                'choice_label' => 'name',
                'query_builder' => function (PlatformRepository $er) {
                    return $er->createQueryBuilder('p')
                            ->orderBy('p.name', 'ASC');
                },
            ])
            ->add('driver', EntityType::class, [
                'label' => 'Cariste',
                'class' => Driver::class,
                'choice_label' => 'name',
                'query_builder' => function (DriverRepository $er) {
                    return $er->createQueryBuilder('d')
                            ->orderBy('d.name', 'ASC');
                },
            ])
            ->add('logistic_leader', EntityType::class, [
                'label' => 'Responsable logistique',
                'class' => LogisticLeader::class,
                'choice_label' => 'name',
            ])
            ->add('comment', TextType::class, [
                'label' => 'Commentaire',
                'required' => false
            ]);
            // use this for add differents colors by fields don't forget replace 'data => $color'
            if($builder->getData() && $builder->getData()->getTitle() === 'Reception'){
                $color = "#0000ff";
             }else if($builder->getData() && $builder->getData()->getTitle() === 'Expédition'){
                $color = "#088A08";
             }else if($builder->getData() && $builder->getData()->getTitle() === 'Envoi Direct'){
                $color = "#561292";
             }else if($builder->getData() && $builder->getData()->getTitle() === 'Destruction'){
                $color = "#FF0000";
             }else if($builder->getData() && $builder->getData()->getTitle() === 'Inventaire'){
                $color = "#FF8000";
             }else{
                $color = "#2B75D9";
             }
             
            $builder->add('background_color', TextType::class, [
                'label' => 'couleur de fond',
                'required' => false,
                'data' => '#2B75D9',
            ]);
            
            $builder->add('text_color', TextType::class, [
                'label' => 'couleur du text',
                'required' => false,
                'data' => '#040404'
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
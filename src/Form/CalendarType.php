<?php

namespace App\Form;

use App\Entity\Driver;
use App\Entity\Building;
use App\Entity\Calendar;
use App\Entity\Customer;
use App\Entity\Platform;
use App\Entity\Supplier;
use App\Entity\Transporter;
use App\Entity\LogisticLeader;
use App\Repository\DriverRepository;
use Symfony\Component\Form\FormEvent;
use App\Repository\CustomerRepository;
use App\Repository\PlatformRepository;
use App\Repository\SupplierRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use App\Repository\TransporterRepository;
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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
                    'Réception' => 'Réception',
                ],
            ])
            ->add('checked', PasswordType::class, [
                'label' => 'Code cariste',
                'required' => false,
            ])
            ->add('validated', PasswordType::class, [
                'label' => 'Code responsable',
                'required' => false,
            ])
            ->add('speed_save', CheckboxType::class, [
                'label' => 'Mofification rapide',
                'required' => false,
                'data' => false
            ])
            ->add('start', DateTimeType::class, [
                'label' => 'Début rendez vous',
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'hours' => range(8, 18),
                'minutes' => range(0, 0),
                'data' => $builder->getData() && $builder->getData()->getStart() ? $builder->getData()->getStart() : new \DateTime(),
            ])
            ->add('end', DateTimeType::class, [
                'label' => 'Fin rendez vous',
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'hours' => range(9, 19),
                'minutes' => range(0, 0),
                'data' => $builder->getData() && $builder->getData()->getEnd() ? $builder->getData()->getEnd() : new \DateTime(),
            ])
            // ->add('description', ChoiceType::class, [
            //     'label' => 'Marchandise',
            //     'required' => true,
            //     'choices' => [
            //         'Expédié/Contrôlée/enregistré' => 'Expédié/Contrôlée/enregistré',
            //         'Préparation/Expédition/Réception' => 'Préparation/Expédition/Réception',
            //         'Récept/Contrôlé' => 'Récept/Contrôlé',
            //         'Récept/Contrôlée/enregistré' => 'Récept/Contrôlée/enregistré',
            //         'Réceptioné' => 'Réceptioné',
            //         'Refusé' => 'Refusé',
            //     ],
            // ])
            ->add('pallets_number', IntegerType::class, [
                'label' => 'Nbre de palettes'
            ])
            ->add('building', EntityType::class, [
                'label' => 'Quais',
                'class' => Building::class,
                'choice_label' => 'name',
            ])
            ->add('supplier', EntityType::class, [
                'label' => 'Fournisseurs',
                'class' => Supplier::class,
                'choice_label' => 'name',
                'query_builder' => function (SupplierRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.name', 'ASC');
                },
                'placeholder' => 'NON RENSEIGNE', // Ajout de la valeur par défaut
                'empty_data' => null, // Définition de la valeur vide à null
                'required' => false // Rendre le champ facultatif
            ])
            ->add('command_number', TextType::class, [
                'label' => 'N° de commande',
                'required' => true
            ])
            ->add('customer', EntityType::class, [
                'label' => 'Clients',
                'class' => Customer::class,
                'choice_label' => 'name',
                'query_builder' => function (CustomerRepository $er) {
                    return $er->createQueryBuilder('c')
                            ->orderBy('c.name', 'ASC');
                },
                'placeholder' => 'NON RENSEIGNE', // Ajout de la valeur par défaut
                'empty_data' => null, // Définition de la valeur vide à null
                'required' => false // Rendre le champ facultatif
            ])
            ->add('platform', EntityType::class, [
                'label' => 'Platforme',
                'class' => Platform::class,
                'choice_label' => 'name',
                'query_builder' => function (PlatformRepository $er) {
                    return $er->createQueryBuilder('p')
                            ->orderBy('p.name', 'ASC');
                },
                'placeholder' => 'NON RENSEIGNE', // Ajout de la valeur par défaut
                'empty_data' => null, // Définition de la valeur vide à null
                'required' => false // Rendre le champ facultatif
            ])
            ->add('transporter', EntityType::class, [
                'label' => 'Transporteurs',
                'class' => Transporter::class,
                'choice_label' => 'name',
                'query_builder' => function (TransporterRepository $er) {
                    return $er->createQueryBuilder('p')
                            ->orderBy('p.name', 'ASC');
                },
                'placeholder' => 'NON RENSEIGNE', // Ajout de la valeur par défaut
                'empty_data' => null, // Définition de la valeur vide à null
                'required' => false // Rendre le champ facultatif
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
            ->add('contentTruck', TextareaType::class, [
                'label' => 'Contenu du camion',
                'required' => false
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
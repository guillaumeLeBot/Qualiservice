<?php

namespace App\Form;

use App\Entity\DeliverySchedule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DeliveryScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dayCall', DateType::class, [
                'label' => 'Jour d\'appel',
            ])
            ->add('hoursCall', TimeType::class, [
                'label' => 'Heure de l\'appel',
            ])
            ->add('arrivalTime', TimeType::class, [
                'label' => 'Heure d\'arrivée',
            ])
            ->add('appointement', TimeType::class, [
                'label' => 'Rendez vous',
            ])
            ->add('endingAppointement', TimeType::class, [
                'label' => 'Heure de fin de rendez vous',
            ])
            ->add('departureTime', TimeType::class, [
                'label' => 'Heure de Départ',
            ])
            ->add('commandNumber', TextType::class, [
                'label' => 'Numéro de commande'
            ])
            ->add('deliveredShipped', ChoiceType::class, [
                'label' => 'Livraisons/Expédition',
                'choices' => [
                    'reception' => 'reception',
                    'Expédition' => 'Expédition',
                    'Envoi Direct' => 'Envoi Direct',
                    'Réception/Expédition' => 'Réception/Expédition',
                    'Transfert' => 'Transfert',
                    'Destruction' => 'Destruction',
                    'Inventaire' => 'Inventaire'
                ],
            ] )
            ->add('building', ChoiceType::class, [
                'label' => 'Batiment',
                'choices' => [
                    'JDC1' => 'JDC1',
                    'JDC2' => 'JDC2',
                    'Royal Canin' => 'Royal Canin',
                    'JDC1/JDC2' => 'JDC1/JDC2',
                    'JDC2/JDC1' => 'JDC2/JDC1',
                    'Quai salle carton' => 'Quai salle carton'
                ],
            ])
            ->add('platform', ChoiceType::class, [
                'label' => 'Platforme',
                'choices' => [
                    'CLoé' => 'CLoé',
                    'Vémars/Cloé' => 'Vémars/Cloé',
                    'saint Vulbas' => 'saint Vulbas',
                    'SPI' => 'SPI',
                    'SPI/Saint Vulbas' => 'SPI/Saint Vulbas'
                ],
            ])
            ->add('building')
            ->add('platform')
            ->add('supplier')
            ->add('customer')
            ->add('driver')
            ->add('palletsNumbers')
            ->add('merchandise')
            ->add('comment')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DeliverySchedule::class,
        ]);
    }
}

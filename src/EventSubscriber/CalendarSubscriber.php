<?php

namespace App\EventSubscriber;

use App\Entity\DeliverySchedule;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    public static function getDeliverySchedule()
    {
        return [
            DeliverySchedule::class => 'onDeliverySchedule',
        ];
    }

    public function onDeliverySchedule(DeliverySchedule $deliverySchedule): void
    {
        $deliverySchedule->getArrivalTime(new DeliverySchedule(
            'heure d\'arrivée',
            
        ));

        $deliverySchedule->getDepartureTime(new DeliverySchedule(
            'heure de départ',
            
        ));
    }
     public static function getSubscribedEvents()
     {
        return [DeliverySchedule::class => 'onDeliverySchedule'];
     }
}

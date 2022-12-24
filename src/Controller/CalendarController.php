<?php

namespace App\Controller;

use App\Repository\DeliveryScheduleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalendarController extends AbstractController
{
     #[Route('/calendar', name: 'app_calendar')]
    public function index(DeliveryScheduleRepository $delivery): Response
    {
       $events = $delivery->findAll();

        $rdvs = [];

        foreach($events as $event){
            $rdvs[] = [
                
                'id' => $event->getId(),
                'dayCall' => $event->getDayCall()->format('Y-m-d H:i:s'),
                'hoursCall' => $event->getHoursCall()->format('Y-m-d H:i:s'),
                'arrivalTime' => $event->getArrivalTime()->format('H:i:s'),
                'appointement' => $event->getAppointement()->format('H:i:s'),
                'endingAppointement' => $event->getEndingAppointement()->format('H:i:s'),
                'departureTime' => $event->getDepartureTime()->format('H:i:s'),
                'commandNumber' => $event->getCommandNumber(),
                'deliveredShipped' => $event->getDeliveredShipped(),
                'building' => $event->getBuilding(),
                'platform' => $event->getPlatform(),
                'supplier' => $event->getSupplier(),
                'customer' => $event->getCustomer(),
                'driver' => $event->getDriver(),
                'palletsNumbers' => $event->getPalletsNumbers(),
                'merchandise' => $event->getMerchandise(),
                'comment' => $event->getComment(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('calendar/index.html.twig', compact('data'));
    }
}

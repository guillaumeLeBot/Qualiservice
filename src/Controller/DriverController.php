<?php

namespace App\Controller;

use App\Repository\DriverRepository;
use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DriverController extends AbstractController
{
    #[Route('/driver', name: 'app_driver')]
   public function getEventsForAllDrivers(DriverRepository $driverRepository):Response
{
    
    $drivers = $driverRepository->findAll();

    $events = [];
    foreach ($drivers as $driver) {
        $calendars = $driver->getCalendars();
        foreach ($calendars as $calendar) {
            $event = [
                'title' => $calendar->getTitle(),
                'start' => $calendar->getStart()->format('Y-m-d H:i:s'),
                'end' => $calendar->getEnd()->format('Y-m-d H:i:s'),
                'description' => $calendar->getDescription(),
                'background_color' => $calendar->getBackgroundColor(),
                'border_color' => $calendar->getBorderColor(),
                'text_color' => $calendar->getTextColor(),
                'pallets_number' => $calendar->getPalletsNumber(),
                'comment' => $calendar->getComment(),
                'customer' => $calendar->getCustomer()->getName(),
                'supplier' => $calendar->getSupplier()->getName(),
                'driver' => $calendar->getDriver()->getName(),
                'building' => $calendar->getBuilding()->getName(),
                'come' => $calendar->getCome()->format('Y-m-d H:i:s'),
            ];
            $events[] = $event;
        }
    }
     return $this->render('driver/index.html.twig',[
        'event' => $event
    ]);
}

}

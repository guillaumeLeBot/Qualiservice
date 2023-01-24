<?php

namespace App\Controller;

use Dompdf\Dompdf;
use App\Repository\DriverRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DriverController extends AbstractController
{
    #[Route('/driver', name: 'app_driver')]
    public function getEventsForAllDrivers(DriverRepository $driverRepository):Response
    {
        $drivers = $driverRepository->findAll();
        $time_per_pallet = 1.35;
        $events = [];
        foreach ($drivers as $driver) {
            $calendars = $driver->getCalendars();
            foreach ($calendars as $calendar) {
                $event = [
                    'start' => $calendar->getStart()->format('d/m/Y'),
                    'time' => $time_in_seconds = round(($calendar->getPalletsNumber()*$time_per_pallet )*60 %60, 2),
                    'title' => $calendar->getTitle(),
                    'description' => $calendar->getDescription(),
                    'pallets_number' => $calendar->getPalletsNumber(),
                    'comment' => $calendar->getComment(),
                    'customer' => $calendar->getCustomer()->getName(),
                    'supplier' => $calendar->getSupplier()->getName(),
                    'driver' => $calendar->getDriver()->getName(),
                    'building' => $calendar->getBuilding()->getName(),
                    'dock' => $calendar->getDock()->getName(),
                ];
                $events[] = $event;
            }
            $time_formatted = date("H:i:s", mktime(0,0,$time_in_seconds));

        }
        return $this->render('driver/index.html.twig', compact('events', 'drivers'));
    }

    #[Route('/driver/{id}/pdf', name:"app_driver_pdf")]
    public function printPlanning($id, DriverRepository $driverRepository): Response
    {
        $driver = $driverRepository->find($id);
        if (!$driver) {
            return new Response('Ce cariste n\'à pas de taches attribuées', Response::HTTP_NOT_FOUND);
        }
        $time_per_pallet = 1.35;

        $calendars = $driver->getCalendars();
        foreach ($calendars as $calendar) {
            $event = [
                'start' => $calendar->getStart()->format('d/m/Y'),
                'time' => $time_in_seconds = round(($calendar->getPalletsNumber()*$time_per_pallet )*60 %60, 2),
                'title' => $calendar->getTitle(),
                'description' => $calendar->getDescription(),
                'pallets_number' => $calendar->getPalletsNumber(),
                'comment' => $calendar->getComment(),
                'customer' => $calendar->getCustomer()->getName(),
                'supplier' => $calendar->getSupplier()->getName(),
                'driver' => $calendar->getDriver()->getName(),
                'building' => $calendar->getBuilding()->getName(),
                                    'dock' => $calendar->getDock()->getName(),

            ];
            $events[] = $event;
        }
        if(!isset($events)) {
            return $this->render('error/driverErrorPage.html.twig');
        }

        $html = $this->render('driver/print.html.twig', compact('events', 'driver'));

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->set_paper("a4", "landscape");
        $dompdf->render();

        return new Response(
            $dompdf->stream("driver_planning_".$driver->getName().".pdf", ["Attachment" => false]),
            
        );
    }
}
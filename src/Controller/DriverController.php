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
    public function getEventsForAllDrivers(DriverRepository $driverRepository): Response
    {
        $drivers = $driverRepository->findBy([], ['name' => 'ASC']);
        $eventsByDriver = [];
        foreach ($drivers as $driver) {
            $calendars = $driver->getCalendars();
            $events = [];
            foreach ($calendars as $calendar) {
                $event = [
                    'start' => $calendar->getStart()->format('d/m/Y'),
                    'title' => $calendar->getTitle(),
                    'pallets_number' => $calendar->getPalletsNumber(),
                    'comment' => $calendar->getComment(),
                    'customer' => $calendar->getCustomer() ? $calendar->getCustomer()->getName() : 'NON RENSEIGNE',
                    'supplier' => $calendar->getSupplier() ? $calendar->getSupplier()->getName() : 'NON RENSEIGNE',
                    'driver' => $calendar->getDriver()->getName(),
                    'building' => $calendar->getBuilding()->getName(),
                ];
                $events[] = $event;
            }
            if (!empty($events)) {
                $eventsByDriver[$driver->getName()] = $events;
            }
        }
        $now = new \DateTime();

        return $this->render('driver/index.html.twig', compact('eventsByDriver', 'drivers', 'now'));
    }

    #[Route('/driver/{id}/pdf', name:"app_driver_pdf")]
    public function printPlanning($id, DriverRepository $driverRepository): Response
    {
        $driver = $driverRepository->find($id);
        if (!$driver) {
            return new Response('Ce cariste n\'à pas de taches attribuées', Response::HTTP_NOT_FOUND);
        }
        $today = new \DateTime();
        $events= [];
        $calendars = $driver->getCalendars();
        foreach ($calendars as $calendar) {
            if ($calendar->getStart()->format('Y-m-d') === $today->format('Y-m-d')) {
                $event = [
                    'start' => $calendar->getStart()->format('d/m/Y'),
                    'title' => $calendar->getTitle(),
                    'pallets_number' => $calendar->getPalletsNumber(),
                    'comment' => $calendar->getComment(),
                    'customer' => $calendar->getCustomer() ? $calendar->getCustomer()->getName() : 'NON RENSEIGNE',
                    'supplier' => $calendar->getSupplier() ? $calendar->getSupplier()->getName() : 'NON RENSEIGNE',
                    'driver' => $calendar->getDriver()->getName(),
                    'building' => $calendar->getBuilding()->getName(),

                ];
                $events[] = $event;
            }
            if(!isset($events)) {
                return $this->render('error/driverErrorPage.html.twig');
            }
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
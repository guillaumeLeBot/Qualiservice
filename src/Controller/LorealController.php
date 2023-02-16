<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LorealController extends AbstractController
{
    #[Route('/loreal', name: 'app_loreal')]
    public function index(CalendarRepository $calendarRepository, CustomerRepository $customerRepository): Response
    {
        $customer = $customerRepository->findOneBy(['name' => 'Loreal']);
        $calendarEvents = $calendarRepository->findBy(['customer' => $customer]);
        $events = [];
        foreach ($calendarEvents as $calendar) {
        $checkedAt = null;
        $validatedAt = null;
        if ($calendar->getCheckedAt() !== null) {
            $checkedAt = $calendar->getCheckedAt()->format('Y-m-d H:i:s');
        }

        if ($calendar->getValidatedAt() !== null) {
            $validatedAt = $calendar->getValidatedAt()->format('Y-m-d H:i:s');
        }
            $event = [
                'start' => $calendar->getStart()->format('d/m/Y h:i:s'),
                'end' => $calendar->getEnd()->format('d/m/Y h:i:s'),
                'title' => $calendar->getTitle(),
                'description' => $calendar->getDescription(),
                'pallets_number' => $calendar->getPalletsNumber(),
                'comment' => $calendar->getComment(),
                'checkedAt' => $checkedAt,
                'validatedAt' => $validatedAt,
                
            ];
            $events[] = $event;
        }
        
        return $this->render('loreal/index.html.twig', compact('events'));
    }
}
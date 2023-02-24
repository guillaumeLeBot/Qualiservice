<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Form\CalendarType;
use App\Repository\CalendarRepository;
use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('main/nav.html.twig');
    }

    #[Route('/calendar/view', name: 'app_calendar')]
    public function calendar(CalendarRepository $calendarRepository, CustomerRepository $customerRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $events = $calendarRepository->findAll();

            $rdvs = [];

            foreach($events as $event){
                $rdvs[] = [
                    'id' => $event->getId(),
                    'title' => $event->getTitle(),                
                    'backgroundColor'=> $event->getBackgroundColor(),
                    'start' => $event->getStart()->format('Y-m-d H:i:s'),
                    'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                    'building' => $event->getBuilding()->getName(),
                    'customer' => $event->getCustomer()->getName(),
                    'palletsNumber' => $event->getPalletsNumber(),
                ];
            }
            $data = json_encode($rdvs);

            return $this->render('main/index.html.twig', compact('data'));
        }
        if ($this->isGranted('ROLE_LOREAL')) {
            $customer = $customerRepository->findOneBy(['name' => 'Loreal']);
            $events = $calendarRepository->findBy(['customer' => $customer]);

            $rdvs = [];

            foreach($events as $event){
                $rdvs[] = [
                    'id' => $event->getId(),
                    'title' => $event->getTitle(),                
                    'backgroundColor'=> $event->getBackgroundColor(),
                    'start' => $event->getStart()->format('Y-m-d H:i:s'),
                    'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                    'contentTruck' => $event->getContentTruck(),
                    'customer' => $event->getCustomer()->getName(),
                    'palletsNumber' => $event->getPalletsNumber(),
                ];
            }
            $data = json_encode($rdvs);

            return $this->render('main/index.html.twig', compact('data'));
        }
    }

    #[Route('/calendar/building/manager', name: 'app_building_manager')]
    public function buildingManagement(CalendarRepository $calendarRepository)
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $events = $calendarRepository->findAll();
            $rdvsByBuilding = [];
            foreach ($events as $event) {
                $building = $event->getBuilding();
                if ($building !== null) {
                    $buildingName = $building->getName();
                    if (!isset($rdvsByBuilding[$buildingName])) {
                        $rdvsByBuilding[$buildingName] = [];
                    }
                    $eventData = [
                        'id' => $event->getId(),
                        'title' => $event->getTitle(),
                        'comandNumber' => $event->getCommandNumber(),
                        'backgroundColor' => $event->getBackgroundColor(),
                        'start' => $event->getStart()->format('Y-m-d H:i:s'),
                        'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                        'building' => $buildingName,
                        'customer' => $event->getCustomer()->getName(),
                        'palletsNumber' => $event->getPalletsNumber(),
                        'transporter' => $event->getTransporter()->getName(),
                        'validatedAt' => $event->getValidatedAt() != null ? $event->getValidatedAt()->format('d-m-Y') : null,
                        'checkedAt' => $event->getCheckedAt() != null ? $event->getCheckedAt()->format('d-m-Y') : null,
                    ];
                    $rdvsByBuilding[$buildingName][] = $eventData;
                }
            }
            $now = new \DateTime();
            return $this->render('main/building-manager.html.twig', [
                'rdvsByBuilding' => $rdvsByBuilding,
                'now' => $now
            ]);
        }
        return $this->redirectToRoute('app_building_manager');
        // if ($this->isGranted('ROLE_LOREAL')) {
        //     return $this->redirectToRoute('app_calendar');
        // }
    }
}


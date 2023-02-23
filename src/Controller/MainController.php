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
        foreach($events as $event){
            $building = $event->getBuilding();
            if ($building !== null) {
                $buildingName = $building->getName();
                if (!isset($rdvsByBuilding[$buildingName])) {
                    $rdvsByBuilding[$buildingName] = [];
                }
                $rdvsByBuilding[$buildingName][] = [
                    'id' => $event->getId(),
                    'title' => $event->getTitle(),                
                    'backgroundColor'=> $event->getBackgroundColor(),
                    'start' => $event->getStart()->format('Y-m-d H:i:s'),
                    'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                    'building' => $buildingName,
                    'customer' => $event->getCustomer()->getName(),
                    'palletsNumber' => $event->getPalletsNumber(),
                    'transporter' => $event->getTransporter()->getName(),
                ];
            }
        }
        $now = new \DateTime();
        return $this->render('main/building-manager.html.twig', [
            'rdvsByBuilding' => $rdvsByBuilding,
            'now' => $now
        ]);
    }
    }

    // #[Route('/building/manager/new', name: 'manager_new', methods: ['GET', 'POST'])]
    // public function newFromBuilding(Request $request, CalendarRepository $calendarRepository): Response
    // {
    //     if (!in_array("ROLE_ADMIN", $this->getUser()->getRoles()) && !in_array("ROLE_SUPER_ADMIN", $this->getUser()->getRoles())) {
    //         return new Response('<script>alert("Vous n\'êtes pas autorisé à créer des évenements"); window.location.href = "/calendar/view"</script>', Response::HTTP_FORBIDDEN);
    //     }
        
    //     $calendar = new Calendar();        
    //     $form = $this->createForm(CalendarType::class, $calendar);
    //     $form->handleRequest($request);
        
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         // Get the start and end time of the new event
    //         $startTime = $calendar->getStart();
    //         $endTime = $calendar->getEnd();

    //         // Check if there is any overlapping event in the database
    //         $overlappingEvents = $calendarRepository->findOverlappingEvents($calendar->getBuilding()->getName(), $startTime, $endTime);

    //         if (count($overlappingEvents) > 0) {
    //             // $errorMessage = sprintf("Il existe déjà un évènement %s from %s to %s.", $calendar->getBuilding()->getName(), $startTime->format('H:i'), $endTime->format('H:i'));
    //             return new Response('<script>alert("Il existe déjà un évènement avec ce creneau horaire sur ce quai"); window.location.href = "/calendar/building/manager"</script>', Response::HTTP_FORBIDDEN);
    //         } else {
    //             // Save the new event in the database
    //             $calendarRepository->save($calendar, true);
    //             $this->addFlash('success', 'L\'évènement a été créé avec succès.');
    //             return $this->redirectToRoute('app_building_manager');
    //         }
    //     }
        
    //     return $this->render('partials/_form_new.html.twig', [
    //         'calendar' => $calendar,
    //         'form' => $form->createView(),
    //     ]);
    // }
}


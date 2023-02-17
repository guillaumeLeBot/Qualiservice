<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use App\Repository\CustomerRepository;
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
                    'building' => $event->getBuilding()->getName(),
                    'customer' => $event->getCustomer()->getName(),
                    'palletsNumber' => $event->getPalletsNumber(),
                ];
            }
            $data = json_encode($rdvs);

            return $this->render('main/index.html.twig', compact('data'));
        }
    }
}


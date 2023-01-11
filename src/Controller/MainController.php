<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('main/nav.html.twig');
    }

    #[Route('/calendar/view', name: 'app_calendar')]
    public function calendar(CalendarRepository $calendarRepository): Response
    {
      
       $events = $calendarRepository->findAll();

        $rdvs = [];

        foreach($events as $event){
            $rdvs[] = [
                'id' => $event->getId(),
                'title' => $event->getTitle(),                
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
            ];
        }
        $data = json_encode($rdvs);

        return $this->render('main/index.html.twig', compact('data'));
    }
}


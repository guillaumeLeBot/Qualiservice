<?php

namespace App\Controller;


use App\Repository\CalendarRepository;
use App\Repository\DriverCheckedRepository;
use App\Repository\LeaderCheckedRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatisticsController extends AbstractController
{

    #[Route('/calendar/statistics', name: 'app_statistics')]
    public function index(CalendarRepository $calendarRepository, DriverCheckedRepository $driverCheckedRepository, LeaderCheckedRepository$leaderCheckedRepository):Response
    {
        $calendars = $calendarRepository->findAll();
        // $driverCheckeds = $driverCheckedRepository->findAll();
        // $leaderCheckeds = $leaderCheckedRepository->findAll();


        return $this->render('statistics/index.html.twig', [
            'calendars' => $calendars,
            // 'driverCheckeds' => $driverCheckeds,
            // 'leaderCheckeds' => $leaderCheckeds,
        ]);
    }
}

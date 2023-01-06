<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarVanillaController extends AbstractController
{
    #[Route('/calendar/vanilla', name: 'app_calendar_vanilla')]
    public function index(): Response
    {
        $months = [  [    'name' => 'Janvier',    'daysOfWeek' => ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
    'weeks' => [[1, 2, 3, 4, 5, 6, 7], [8, 9, 10, 11, 12, 13, 14], [15, 16, 17, 18, 19, 20, 21], [22, 23, 24, 25, 26, 27, 28], [29, 30, 31, null, null, null, null]]
  ],
  [    'name' => 'Fevrier',    'daysOfWeek' => ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
    'weeks' => [[1, 2, 3, 4, 5, 6, 7], [8, 9, 10, 11, 12, 13, 14], [15, 16, 17, 18, 19, 20, 21], [22, 23, 24, 25, 26, 27, 28]]
  ],
];
        return $this->render('calendar_vanilla/index.html.twig', [
            'months' => $months,

        ]);
    }
}

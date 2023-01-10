<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DriverController extends AbstractController
{
    #[Route('/driver', name: 'app_driver')]
    public function index(CalendarRepository $calendarRepository): Response
    {
        $calendarData = $calendarRepository->findAll();
        return $this->render('driver/index.html.twig', [
            'calendarData' => $calendarData,
        ]);
    }
}

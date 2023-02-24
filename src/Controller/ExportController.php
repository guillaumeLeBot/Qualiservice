<?php

namespace App\Controller;

use App\Form\CalendarType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;



class ExportController extends AbstractController
{
    #[Route('/export', name: 'app_export')]
    public function index(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(CalendarType::class);
        $form->handleRequest($request);

        $calendars = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $startDate = $data['startDate'];
            $endDate = $data['endDate'];

            $calendars = $doctrine()
                ->getRepository(Calendar::class)
                ->findByDateRange($startDate, $endDate);
        }
        dd($doctrine);
        return $this->render('export_calendar/index.html.twig', [
            'form' => $form->createView(),
            'calendars' => $calendars,
        ]);
    }
}
<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExportController extends AbstractController
{
    #[Route('/export', name: 'app_export')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ExportCalendarType::class);
        $form->handleRequest($request);

        $calendars = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $startDate = $data['startDate'];
            $endDate = $data['endDate'];

            $calendars = $this->getDoctrine()
                ->getRepository(Calendar::class)
                ->findByDateRange($startDate, $endDate);
        }

        return $this->render('export_calendar/index.html.twig', [
            'form' => $form->createView(),
            'calendars' => $calendars,
        ]);
    }
}
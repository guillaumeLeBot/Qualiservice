<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Repository\CalendarRepository;
use App\Repository\CustomerRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\HttpFoundation\Request;
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
                'start' => $calendar->getStart(),
                'end' => $calendar->getEnd()->format('d/m/Y H:i:s'),
                'title' => $calendar->getTitle(),
                'command_number' => $calendar->getCommandNumber(),
                'pallets_number' => $calendar->getPalletsNumber(),
                'content_truck' => $calendar->getContentTruck(),
                'comment' => $calendar->getComment(),
                'checkedAt' => $checkedAt,
                'validatedAt' => $validatedAt,
                
            ];
            $now = new \DateTime();
            $events[] = $event;
        }
        
        return $this->render('loreal/index.html.twig', compact('events', 'now'));
    }

    #[Route('/loreal/export', name: 'app_loreal_export')]
    public function export(CalendarRepository $calendarRepository, CustomerRepository $customerRepository, Request $request): Response
    {
        // Get L'Oréal customer object
        $lorealCustomer = $customerRepository->findOneBy(['name' => 'Loreal']);

        // Get start and end dates from request parameters
        $startDate = $request->query->get('start_date');
        $endDate = $request->query->get('end_date');

        // Convert start and end dates to DateTimeInterface objects
        $startDate = \DateTime::createFromFormat('Y-m-d', $startDate);
        $endDate = \DateTime::createFromFormat('Y-m-d', $endDate);

        // Find calendar events for L'Oréal customer in date range
        $calendarEvents = [];
        if($lorealCustomer == "LOREAL"){
            $calendarEvents = $calendarRepository->findLorealEventsByDate($startDate, $endDate);
        }
        
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Type');
        $sheet->setCellValue('B1', 'Date arrivée / départ prévu');
        $sheet->setCellValue('C1', 'Numéro LS');
        $sheet->setCellValue('D1', 'Nbr de palettes');
        $sheet->setCellValue('E1', 'Contenu du camion');
        $sheet->setCellValue('F1', 'Date de contrôle marchandises');

        // Set data
        $rowIndex = 2;
        foreach ($calendarEvents as $event) {
            if ($event->getCustomer() == $lorealCustomer) {
                $sheet->setCellValue('A' . $rowIndex, $event->getTitle());
                $sheet->setCellValue('B' . $rowIndex, $event->getStart()->format('d-m-Y H:i:s'));
                $sheet->setCellValue('C' . $rowIndex, $event->getCommandNumber());
                $sheet->setCellValue('D' . $rowIndex, $event->getPalletsNumber());
                $sheet->setCellValue('E' . $rowIndex, $event->getContentTruck());
                $sheet->setCellValue('F' . $rowIndex, $event->getCheckedAt());
                $rowIndex++;
            }
        }

        // Create a new CSV writer object
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);

        // Set the output file name
        $fileName = 'loreal_planning.csv';

        // Create the response object
        $response = new Response();

        // Set the response headers
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        // Set the content of the response to the CSV file
        ob_start();
        $writer->save('php://output');
        $csvContent = ob_get_clean();
        $response->setContent($csvContent);
        return $response;
    }
}
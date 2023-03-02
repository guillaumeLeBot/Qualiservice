<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Form\CalendarType;
use App\Repository\CalendarRepository;
use App\Repository\CustomerRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
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
        // if ($this->isGranted('ROLE_ADMIN')) {
        //     $events = $calendarRepository->findAll();

        //     $rdvs = [];

        //     foreach($events as $event){
        //         $rdvs[] = [
        //             'id' => $event->getId(),
        //             'title' => $event->getTitle(),                
        //             'backgroundColor'=> $event->getBackgroundColor(),
        //             'start' => $event->getStart()->format('Y-m-d H:i:s'),
        //             'end' => $event->getEnd()->format('Y-m-d H:i:s'),
        //             'building' => $event->getBuilding()->getName(),
        //             'customer' => $event->getCustomer()->getName(),
        //             'palletsNumber' => $event->getPalletsNumber(),
        //         ];
        //     }
        //     $data = json_encode($rdvs);

        //     return $this->render('main/index.html.twig', compact('data'));
        // }
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
        } elseif ($this->isGranted('ROLE_LOREAL')) {
            return $this->redirectToRoute('app_loreal');
        } else {
            return $this->redirectToRoute('app_login');
        }
        
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

    #[Route('/calendar/building/export', name: 'app_building_export')]
    public function export(CalendarRepository $calendarRepository, CustomerRepository $customerRepository, Request $request): Response
    {
        // Get start and end dates from request parameters
        $startDate = $request->query->get('start_date');
        $endDate = $request->query->get('end_date');

        // Convert start and end dates to DateTimeInterface objects
        $startDate = \DateTime::createFromFormat('Y-m-d', $startDate);
        $endDate = \DateTime::createFromFormat('Y-m-d', $endDate);

        // Find calendar events in date range
        $calendarEvents = $calendarRepository->findByDateRange($startDate, $endDate);
            
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
        $sheet->setCellValue('G1', 'Client');
        
        // Set data
        $rowIndex = 2;
        foreach ($calendarEvents as $event) {
            $sheet->setCellValue('A' . $rowIndex, $event->getTitle());
            $sheet->setCellValue('B' . $rowIndex, $event->getStart()->format('d-m-Y H:i:s'));
            $sheet->setCellValue('C' . $rowIndex, $event->getCommandNumber());
            $sheet->setCellValue('D' . $rowIndex, $event->getPalletsNumber());
            $sheet->setCellValue('E' . $rowIndex, $event->getContentTruck());
            $sheet->setCellValue('F' . $rowIndex, $event->getCheckedAt());
            $sheet->setCellValue('G' . $rowIndex, $event->getCustomer()->getName());
            $rowIndex++;
        }
        
        // Create a new CSV writer object
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        
        // Set the output file name
        $fileName = 'Qualiservice_planning.csv';
        
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


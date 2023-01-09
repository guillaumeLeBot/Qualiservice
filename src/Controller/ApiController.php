<?php

namespace App\Controller;

use App\Entity\Calendar;
use DateTime;
use App\Entity\DeliverySchedule;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    
    #[Route('/api', name: 'api')]
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    
    #[Route('/api/{id}/edit', name:'api_event_edit', methods:['PUT'])]

    public function majEvent(?Calendar $calendar, Request $request, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        // On récupère les données
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->borderColor) && !empty($donnees->borderColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ){
            // Les données sont complètes
            // On initialise un code
            $code = 200;

            // On vérifie si l'id existe
            if(!$calendar){
                // On instancie un rendez-vous
                $calendar = new Calendar;

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les données
            $calendar->setTitle($donnees->title);
            $calendar->setDescription($donnees->description);
            $calendar->setStart(new DateTime($donnees->start));
            if($donnees->allDay){
                $calendar->setEnd(new DateTime($donnees->start));
            }else{
                $calendar->setEnd(new DateTime($donnees->end));
            }
            $calendar->setAllDay($donnees->allDay);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setBorderColor($donnees->borderColor);
            $calendar->setTextColor($donnees->textColor);
           

            $em->persist($calendar);
            $em->flush();

            // On retourne le code
            return new Response('Ok', $code);
        }else{
            // Les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }


        return $this->render('calendar/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    #[Route('/api/{id}/update', name:'api_event_update', methods:['POST'])]

    public function majEventClic(?Calendar $calendar, Request $request, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        // On récupère les données
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->borderColor) && !empty($donnees->borderColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)&&
            isset($donnees->pallets_number) && !empty($donnees->pallets_number)&&
            isset($donnees->building) && !empty($donnees->building)&&
            isset($donnees->supplier) && !empty($donnees->supplier)&&
            isset($donnees->customer) && !empty($donnees->customer)&&
            isset($donnees->driver) && !empty($donnees->driver)&&
            isset($donnees->merchandise) && !empty($donnees->textColor)
        ){
            // Les données sont complètes
            // On initialise un code
            $code = 200;

            // On vérifie si l'id existe
            if(!$calendar){
                // On instancie un rendez-vous
                $calendar = new Calendar;

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les données
            $calendar->setTitle($donnees->title);
            $calendar->setDescription($donnees->description);
            $calendar->setStart(new DateTime($donnees->start));
            if($donnees->allDay){
                $calendar->setEnd(new DateTime($donnees->start));
            }else{
                $calendar->setEnd(new DateTime($donnees->end));
            }
            $calendar->setAllDay($donnees->allDay);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setBorderColor($donnees->borderColor);
            $calendar->setTextColor($donnees->textColor);
            $calendar->setPalletsNumber($donnees->pallets_number);
            $calendar->setBuilding($donnees->building);
            $calendar->setSupplier($donnees->supplier);
            $calendar->setCustomer($donnees->customer);
            $calendar->setDriver($donnees->driver);
            $calendar->setMerchandise($donnees->merchandise);
           

            $em->persist($calendar);
            $em->flush();

            // On retourne le code
            return new Response('Ok', $code);
        }else{
            // Les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }


        return $this->render('calendar/edit.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
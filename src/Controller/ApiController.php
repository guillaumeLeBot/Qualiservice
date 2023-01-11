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

    
    #[Route('/api/{id}/drag_edit', name:'api_event_edit', methods:['PUT'])]

    public function majEvent(?Calendar $calendar, Request $request, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        // On récupère les données
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->end)
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
            $calendar->setStart(new DateTime($donnees->start));
            $calendar->setEnd(new DateTime($donnees->end));
            

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
}
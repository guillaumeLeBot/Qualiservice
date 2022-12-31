<?php

namespace App\Controller;

use App\Entity\DeliverySchedule;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?DeliverySchedule $deliverySchedule, Request $request, EntityManagerInterface $em)
    {
        // On récupère les données
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->arrivalTime) && !empty($donnees->arrivalTime) &&
            isset($donnees->driver) && !empty($donnees->driver) &&
            isset($donnees->departureTime) && !empty($donnees->departureTime) 
        ){
            // Les données sont complètes
            // On initialise un code
            $code = 200;

            // On vérifie si l'id existe
            if(!$deliverySchedule){
                // On instancie un rendez-vous
                $deliverySchedule = new DeliverySchedule;

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les données
            $deliverySchedule->setArrivalTime($donnees->arrivalTime);
            $deliverySchedule->setDriver($donnees->driver);
            if($donnees->dayCall){
                $deliverySchedule->setDepartureTime(new DateTime($donnees->departureTime));
            }else{
                $deliverySchedule->setDepartureTime(new DateTime($donnees->departureTime));
            }
           

            $em = $this->$this->getDoctrine();
            $em->persist($deliverySchedule);
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
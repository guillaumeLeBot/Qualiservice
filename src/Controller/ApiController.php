<?php

namespace App\Controller;

use DateTime;
use App\Entity\Building;
use App\Entity\Calendar;
use App\Entity\Customer;
use App\Repository\CalendarRepository;
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
        if (!in_array("ROLE_ADMIN", $this->getUser()->getRoles()) && !in_array("ROLE_SUPER_ADMIN", $this->getUser()->getRoles())) {
            return new Response('<script>alert("Vous n\'êtes pas autorisé à créer des évenements"); window.location.href = "/calendar/view"</script>', Response::HTTP_FORBIDDEN);
        }
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    
    #[Route('/api/{id}/drag_edit', name:'api_event_edit', methods:['PUT'])]

    public function majEvent(?Calendar $calendar, Request $request, ManagerRegistry $doctrine)
    {
        if (!in_array("ROLE_ADMIN", $this->getUser()->getRoles()) && !in_array("ROLE_SUPER_ADMIN", $this->getUser()->getRoles())) {
            return new Response('<script>alert("Vous n\'êtes pas autorisé à créer des évenements"); window.location.href = "/calendar/view"</script>', Response::HTTP_FORBIDDEN);
        }
        $em = $doctrine->getManager();
        // On récupère les données
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            // isset($donnees->building) && !empty($donnees->building) &&
            // isset($donnees->palletsNumber) && !empty($donnees->palletsNumber) &&
            // isset($donnees->customer) && !empty($donnees->customer) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->end)
        ){
            // Check if calendar has been validated
        if($calendar->getValidatedAt() !== null) {
            return new Response('<script>alert("This event cannot be edited because it has already been validated"); window.location.href = "/calendar/view"</script>', Response::HTTP_FORBIDDEN);
        }
        if($calendar->getCheckedAt() !== null) {
            return new Response('<script>alert("This event cannot be edited because it has already been validated"); window.location.href = "/calendar/view"</script>', Response::HTTP_FORBIDDEN);
        }
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
            $calendar->getId($donnees->id);
            $calendar->setTitle($donnees->title);
            // $calendar->setPalletsNumber($donnees->palletsNumber);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setStart(new DateTime($donnees->start));
            $calendar->setEnd(new DateTime($donnees->end));

            // $buildingId = $donnees->building;
            // $customerId = $donnees->customer;

            // if (!is_string($buildingId) || !is_string($customerId)) {
            //     return new Response('ID invalide', 400);
            // }

            // $building = $em->getRepository(Building::class)->find($buildingId);
            // if ($building) {
            //     $calendar->setBuilding($building);
            //     $donnees->building_name = $building->getName();
            // }
            
            // $customer = $em->getRepository(Customer::class)->find($customerId);
            // if ($customer) {
            //     $calendar->setCustomer($customer);
            //     $donnees->customer_name = $customer->getName();
            // }
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
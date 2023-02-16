<?php

namespace App\Controller;

use DateTime;
use App\Entity\Driver;
use DateTimeImmutable;
use App\Entity\Calendar;
use App\Events\MailEvent;
use App\Form\CalendarType;
use App\Repository\CalendarRepository;
use App\Repository\DriverCheckedRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/calendar')]
class CalendarController extends AbstractController
{
    #[Route('/', name: 'calendar_index', methods: ['GET'])]
    public function index(CalendarRepository $calendarRepository): Response
    {
        return $this->render('calendar/index.html.twig', [
            'calendars' => $calendarRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'calendar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CalendarRepository $calendarRepository): Response
    {
        if (!in_array("ROLE_ADMIN", $this->getUser()->getRoles()) && !in_array("ROLE_SUPER_ADMIN", $this->getUser()->getRoles())) {
            return new Response('<script>alert("Vous n\'êtes pas autorisé à créer des évenements"); window.location.href = "/calendar/view"</script>', Response::HTTP_FORBIDDEN);
        }
        $calendar = new \DateTime($request->query->get('start'));
        $calendar = new Calendar();        
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);
        //TODO check attribute docks vs time
        // $events = $calendarRepository->findAll();
        // foreach ($events as $event) {
        //     if ($event->getStart() == $calendar->getStart() && $event->getBuilding()->getName() == $calendar->getBuilding()->getName()) {
        //         // Si l'événement en cours de traitement a lieu au même moment et dans le même quai que l'événement en cours de création, cela signifie qu'il y a un conflit.
        //         return $this->redirectToRoute('app_calendar');
        //         $this->addFlash('message',"Ce quai est déjà réservé à cet horaire");
        //     }
        // }
        if ($form->isSubmitted() && $form->isValid()) {
        
        $calendarRepository->save($calendar, true);
        return $this->redirectToRoute('app_calendar');
        }
        return $this->render('calendar/new.html.twig', [
            'calendar' => $calendar,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/show', name: 'calendar_show', methods: ['GET'])]
    public function show(Request $request, Calendar $calendar): Response
    {
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);
        

        return $this->render('calendar/show.html.twig', [
            'calendar' => $calendar,
            'form' => $form->createView(),
        ]);
    }

    #[route('/{id}/edit', name:'calendar_edit', methods:['GET', 'POST', 'PUT'])]
    public function edit(Request $request, Calendar $calendar, CalendarRepository $calendarRepository, EventDispatcherInterface $eventDispatcher): Response
    {
        if ($this->getUser() == null) {
        return $this->redirectToRoute('app_login');
        } elseif ($this->getUser()->getRoles() == ["ROLE_LOREAL"]) {
            return $this->redirectToRoute("calendar_show", ['id' => $calendar->getId()]);
        }
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($calendar->isSpeedSave()){
                $calendar->setBackgroundColor('red');
                $calendarRepository->save($calendar, true);
                return $this->redirectToRoute('app_calendar');
            }
            if($calendar->getValidated() == $calendar->getLogisticLeader()->getCode()){
                $validate = new DateTimeImmutable();
                $validatedBy = $calendar->getLogisticLeader()->getName();
                $calendar->setValidatedAt($validate);
                $calendar->setValidatedBy($validatedBy);
                $calendar->setBackgroundColor('green');
                // return $this->redirectToRoute('app_check_list_validator');
                $mailEvent = new MailEvent($calendar);
                $eventDispatcher->dispatch($mailEvent, 'sendMail.supplierr');
                if($eventDispatcher->dispatch($mailEvent, 'sendMail.supplier')){
                    $emailDeparureAt = new \DateTime();
                    $calendar->setEmailDeparureAt($emailDeparureAt);
                }
                $calendarRepository->save($calendar, true);
                return $this->redirectToRoute('app_leader_checked_new');
                return $this->redirectToRoute('app_calendar');
            }
            if($calendar->getChecked() == $calendar->getDriver()->getCode()){
                $checked = new DateTimeImmutable();
                $checkedBy = $calendar->getDriver()->getName();
                $calendar->setCheckedAt($checked);
                $calendar->setCheckedBy($checkedBy);
                $calendar->setBackgroundColor('orange');
                $mailEvent = new MailEvent($calendar);
                $eventDispatcher->dispatch($mailEvent, 'sendMail.customer');
                if($eventDispatcher->dispatch($mailEvent, 'sendMail.customer')){
                    $emailComeAt = new \DateTime();
                    $calendar->setEmailComeAt($emailComeAt);
                }
                $calendarRepository->save($calendar, true);
                return $this->redirectToRoute('app_driver_checked_new');
                return $this->redirectToRoute('app_calendar');
            }else {
                $this->addFlash('message', 'Vous devez entrer un code cariste pour débuter la prise en charge camion ou faire une modification rapide en cochant la case en bas du formulaire.');
            }
        }
        return $this->render('calendar/edit.html.twig', [
            'calendar' => $calendar,
            'form' => $form->createView(),
        ]);
    }

    #[route('/{id}/delete', name:'calendar_delete', methods:['POST'])]
    public function delete(Request $request, Calendar $calendar, CalendarRepository $calendarRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendar->getId(), $request->request->get('_token'))) {
            $calendarRepository->remove($calendar, true);
        }

        return $this->redirectToRoute('app_calendar');

    }
}
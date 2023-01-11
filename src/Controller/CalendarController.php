<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Form\CalendarType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function new(Request $request, CalendarRepository $calendarRepository, MailerInterface $mailerInterface): Response
    {
        $calendar = new \DateTime($request->query->get('start'));
        $calendar = new Calendar();
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
        if ($calendar->getDeparure() && $request->request->get('send_mail')) {
                $mailerInterface = (new Email())
                    ->from('sender@example.com')
                    ->to('receiver@example.com')
                    ->subject('Mail de confirmation de départ')
                    ->text('Votre départ a bien été enregistré.');
        }
        $calendarRepository->save($calendar, true);
        return $this->redirectToRoute('app_calendar');
        }
        return $this->render('calendar/new.html.twig', [
            'calendar' => $calendar,
            'form' => $form->createView(),
            // 'sentMail' => $sentMail,
        ]);
    }

    #[Route('/{id}/show', name: 'calendar_show', methods: ['GET'])]
    public function show(Calendar $calendar): Response
    {
        return $this->render('calendar/show.html.twig', [
            'calendar' => $calendar,
        ]);
    }

   
    #[route('/{id}/edit', name:'calendar_edit', methods:['GET', 'POST', 'PUT'])]
    public function edit(Request $request, Calendar $calendar, CalendarRepository $calendarRepository): Response
    {
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendarRepository->save($calendar, true);

            return $this->redirectToRoute('app_calendar');
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
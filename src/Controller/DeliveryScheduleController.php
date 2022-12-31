<?php

namespace App\Controller;

use App\Entity\DeliverySchedule;
use App\Form\DeliveryScheduleType;
use App\Repository\DeliveryScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/delivery')]
class DeliveryScheduleController extends AbstractController
{
    #[Route('/', name: 'app_delivery_schedule_index', methods: ['GET'])]
    public function index(DeliveryScheduleRepository $deliveryScheduleRepository): Response
    {
        return $this->render('delivery_schedule/index.html.twig', [
            'delivery_schedules' => $deliveryScheduleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_delivery_schedule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DeliveryScheduleRepository $deliveryScheduleRepository): Response
    {
        $deliverySchedule = new DeliverySchedule();
        $form = $this->createForm(DeliveryScheduleType::class, $deliverySchedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deliveryScheduleRepository->save($deliverySchedule, true);

            return $this->redirectToRoute('app_delivery_schedule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('delivery_schedule/new.html.twig', [
            'delivery_schedule' => $deliverySchedule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_delivery_schedule_show', methods: ['GET'])]
    public function show(DeliverySchedule $deliverySchedule): Response
    {
        return $this->render('delivery_schedule/show.html.twig', [
            'delivery_schedule' => $deliverySchedule,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_delivery_schedule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DeliverySchedule $deliverySchedule, DeliveryScheduleRepository $deliveryScheduleRepository): Response
    {
        $form = $this->createForm(DeliveryScheduleType::class, $deliverySchedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deliveryScheduleRepository->save($deliverySchedule, true);

            return $this->redirectToRoute('app_delivery_schedule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('delivery_schedule/edit.html.twig', [
            'delivery_schedule' => $deliverySchedule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_delivery_schedule_delete', methods: ['POST'])]
    public function delete(Request $request, DeliverySchedule $deliverySchedule, DeliveryScheduleRepository $deliveryScheduleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deliverySchedule->getId(), $request->request->get('_token'))) {
            $deliveryScheduleRepository->remove($deliverySchedule, true);
        }

        return $this->redirectToRoute('app_delivery_schedule_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\DriverChecked;
use App\Form\DriverCheckedType;
use App\Repository\DriverCheckedRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/driver/checked')]
class DriverCheckedController extends AbstractController
{
    #[Route('/', name: 'app_driver_checked_index', methods: ['GET'])]
    public function index(DriverCheckedRepository $driverCheckedRepository): Response
    {
        return $this->render('driver_checked/index.html.twig', [
            'driver_checkeds' => $driverCheckedRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_driver_checked_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DriverCheckedRepository $driverCheckedRepository, ValidatorInterface $validator): Response
    {
        $driverChecked = new DriverChecked();
        $form = $this->createForm(DriverCheckedType::class, $driverChecked);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $startLoading = $driverChecked->getStartLoading();
                $stopLoading = $driverChecked->getStopLoading();
                $duration = $startLoading->diff($stopLoading)->format('%H:%I:%S');
                $driverChecked->setDurationLoading($duration);
                $errors = $validator->validate($driverChecked);

                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            $this->addFlash('error', $error->getMessage());
                        }
                    } else {
                        $driverCheckedRepository->save($driverChecked, true);
                        return $this->redirectToRoute('app_calendar', [], Response::HTTP_SEE_OTHER);
                    }
        }
        
        return $this->renderForm('driver_checked/new.html.twig', [
            'driver_checked' => $driverChecked,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_driver_checked_show', methods: ['GET'])]
    public function show(DriverChecked $driverChecked): Response
    {
        return $this->render('driver_checked/show.html.twig', [
            'driver_checked' => $driverChecked,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_driver_checked_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DriverChecked $driverChecked, DriverCheckedRepository $driverCheckedRepository): Response
    {
        $form = $this->createForm(DriverCheckedType::class, $driverChecked);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $driverCheckedRepository->save($driverChecked, true);

            $calendarForm = $this->createForm(CalendarForm::class);
            $calendarForm->handleRequest($request);
            if ($calendarForm->isSubmitted() && $calendarForm->isValid()) {
                
            }

            return $this->redirectToRoute('app_driver_checked_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('driver_checked/edit.html.twig', [
            'driver_checked' => $driverChecked,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_driver_checked_delete', methods: ['POST'])]
    public function delete(Request $request, DriverChecked $driverChecked, DriverCheckedRepository $driverCheckedRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$driverChecked->getId(), $request->request->get('_token'))) {
            $driverCheckedRepository->remove($driverChecked, true);
        }

        return $this->redirectToRoute('app_driver_checked_index', [], Response::HTTP_SEE_OTHER);
    }
}

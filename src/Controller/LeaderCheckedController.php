<?php

namespace App\Controller;

use App\Entity\LeaderChecked;
use App\Form\LeaderCheckedType;
use App\Repository\LeaderCheckedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/leader/checked')]
class LeaderCheckedController extends AbstractController
{
    #[Route('/', name: 'app_leader_checked_index', methods: ['GET'])]
    public function index(LeaderCheckedRepository $leaderCheckedRepository): Response
    {
        return $this->render('leader_checked/index.html.twig', [
            'leader_checkeds' => $leaderCheckedRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_leader_checked_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LeaderCheckedRepository $leaderCheckedRepository): Response
    {
        $leaderChecked = new LeaderChecked();
        $form = $this->createForm(LeaderCheckedType::class, $leaderChecked);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $leaderCheckedRepository->save($leaderChecked, true);

            return $this->redirectToRoute('app_building_manager', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('leader_checked/new.html.twig', [
            'leader_checked' => $leaderChecked,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_leader_checked_show', methods: ['GET'])]
    public function show(LeaderChecked $leaderChecked): Response
    {
        return $this->render('leader_checked/show.html.twig', [
            'leader_checked' => $leaderChecked,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_leader_checked_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LeaderChecked $leaderChecked, LeaderCheckedRepository $leaderCheckedRepository): Response
    {
        $form = $this->createForm(LeaderCheckedType::class, $leaderChecked);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $leaderCheckedRepository->save($leaderChecked, true);

            return $this->redirectToRoute('app_leader_checked_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('leader_checked/edit.html.twig', [
            'leader_checked' => $leaderChecked,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_leader_checked_delete', methods: ['POST'])]
    public function delete(Request $request, LeaderChecked $leaderChecked, LeaderCheckedRepository $leaderCheckedRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$leaderChecked->getId(), $request->request->get('_token'))) {
            $leaderCheckedRepository->remove($leaderChecked, true);
        }

        return $this->redirectToRoute('app_leader_checked_index', [], Response::HTTP_SEE_OTHER);
    }
}

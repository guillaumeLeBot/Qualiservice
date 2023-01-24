<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HumanResourcesController extends AbstractController
{
    #[Route('/rh', name: 'app_human_resources')]
    public function index(): Response
    {
        return $this->render('partials/_notfound_wip.html.twig');
    }
}

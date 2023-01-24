<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IntranetController extends AbstractController
{
    #[Route('/intranet', name: 'app_intranet')]
    public function index(): Response
    {
        // return $this->render('partials/_notfound_wip2.html.twig');
        return $this->render('intranet/index.html.twig');
    }
}

<?php

namespace App\Controller;

use App\Entity\Calendar;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckListValidatorController extends AbstractController
{
    #[Route('/check/list/validator', name: 'app_check_list_validator')]
    public function index(): Response
    {

        
        $items = [
            ['name' => 'item 1', 'checked' => true],
            ['name' => 'item 2', 'checked' => false],
            ['name' => 'item 3', 'checked' => true],
            // ...
        ];
        
        return $this->render('check_list_validator/index.html.twig', ['items' => $items]);
    }
}

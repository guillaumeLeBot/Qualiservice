<?php

namespace App\Controller\Admin;

use App\Entity\DeliverySchedule;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
   
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        
    }
    
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        
        $url = $this->adminUrlGenerator
        ->setController(DeliveryScheduleCrudController::class)
        ->generateUrl();
         return $this->redirect($url);

        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Quali Trucks');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Livraison/Expédition', 'fa fa-home')->setSubItems([
         MenuItem::linkToCrud('creation', 'fas fa-plus', DeliverySchedule::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::linkToCrud('platform', 'fas fa-list', DeliverySchedule::class);
        yield MenuItem::linkToCrud('customer', 'fas fa-list', DeliverySchedule::class);
        yield MenuItem::linkToCrud('driver', 'fas fa-list', DeliverySchedule::class);
        yield MenuItem::linkToCrud('delivered_shipped', 'fas fa-list', DeliverySchedule::class);

    }
}

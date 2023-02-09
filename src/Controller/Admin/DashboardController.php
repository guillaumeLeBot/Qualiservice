<?php

namespace App\Controller\Admin;

use App\Entity\Driver;
use App\Entity\Building;
use App\Entity\Customer;
use App\Entity\LogisticLeader;
use App\Entity\Platform;
use App\Entity\Supplier;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
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
        ->setController(CalendarCrudController::class)
        ->generateUrl();
         return $this->redirect($url);

        
    }
    

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Retour vers le Site', 'fa fa-home', '/calendar/view');
        
        yield MenuItem::linkToCrud('Bâtiment', 'fas fa-list', Building::class);
        yield MenuItem::linkToCrud('Caristes', 'fas fa-list', Driver::class);
        yield MenuItem::linkToCrud('Client', 'fas fa-list', Customer::class);
        yield MenuItem::linkToCrud('Fournisseurs', 'fas fa-list', Supplier::class);
        yield MenuItem::linkToCrud('Platforme', 'fas fa-list', Platform::class);
        yield MenuItem::linkToCrud('Responsable logistique', 'fas fa-list',LogisticLeader::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);

    }
}

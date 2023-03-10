<?php

namespace App\Controller\Admin;

use App\Entity\Building;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BuildingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Building::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->hideOnDetail(),
        ];
    }
}

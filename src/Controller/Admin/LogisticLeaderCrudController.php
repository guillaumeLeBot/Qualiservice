<?php

namespace App\Controller\Admin;

use App\Entity\LogisticLeader;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LogisticLeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LogisticLeader::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->hideOnDetail(),
        ];
    }
}

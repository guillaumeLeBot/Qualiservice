<?php

namespace App\Controller\Admin;

use App\Entity\DeliverySchedule;
use App\Form\DeliveryScheduleType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DeliveryScheduleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DeliverySchedule::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('customer'),
            TextField::new('supplier'),
            TextField::new('driver'),
        ];
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Hours;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hours::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Horaire')
            ->setEntityLabelInPlural('Horaires')
            ->setPageTitle('index', 'Administration des horaires');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('dayWeek', 'Jour de la semaine'),
            TimeField::new('morning_open_hours', 'Horaire du matin'),
            TimeField::new('morning_close_hours', 'Horaire du matin'),
            TimeField::new('afternoon_open_hours', 'Horaire de l\'après-midi'),
            TimeField::new('afternoon_close_hours', 'Horaire de l\'après-midi'),
            BooleanField::new('is_open')->setColumns(2),
        ];
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Hours;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
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
            TextField::new('morning_open_hours', 'Horaire d\'ouverture matin'),
            TextField::new('morning_close_hours', 'Horaire de midi'),
            TextField::new('afternoon_open_hours', 'Horaire d\'ouverture après-midi'),
            TextField::new('afternoon_close_hours', 'Horaire de fermeture soir')
        ];
    }
}

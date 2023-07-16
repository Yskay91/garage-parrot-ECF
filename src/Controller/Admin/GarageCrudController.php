<?php

namespace App\Controller\Admin;

use App\Entity\Garage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GarageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Garage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Coordonnées du garage')
            ->setEntityLabelInPlural('Coordonnées du garage')
            ->setPageTitle('index', 'Coordonnées du garage');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('name', 'Nom'),
            TextField::new('adresse', 'Adresse'),
            IntegerField::new('zipCode', 'Code postal'),
            TextField::new('city', 'Ville'),
            TextField::new('phone', 'Téléphone'),
            TextField::new('mail', 'Email'),
        ];
    }
}

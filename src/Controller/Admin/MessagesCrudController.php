<?php

namespace App\Controller\Admin;

use App\Entity\Messages;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MessagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Messages::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Demande de contact')
            ->setEntityLabelInPlural('Demandes de contact')
            ->setPageTitle('index', 'Administration des demandes de contact')
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('nameCustomer', 'Nom'),
            TextField::new('firstNameCustomer', 'Prénom'),
            TextField::new('email', 'Email'),
            TextField::new('telephone', 'Téléphone'),
            TextField::new('subject', 'Sujet'),
            TextEditorField::new('message', 'Message'),
            DateTimeField::new('created_at', 'Créée le')
                ->hideOnForm(),
        ];
    }
}

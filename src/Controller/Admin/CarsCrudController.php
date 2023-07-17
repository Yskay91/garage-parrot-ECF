<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Form\ImagesType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cars::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Annonce')
            ->setEntityLabelInPlural('Annonces')
            ->setPageTitle('index', 'Administration des annonces d\'occasion')
            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('brand', 'Marque'),
            TextField::new('model', 'Modèle'),
            TextareaField::new('features', 'Caractéristiques')
                ->hideOnIndex()
                ->setFormType(CKEditorType::class),
            IntegerField::new('kilometre', 'Kilomètre'),
            IntegerField::new('year', 'Année de mise en circulation'),
            IntegerField::new('price', 'Prix'),
            DateTimeField::new('created_at', 'Créée le')
                ->hideOnForm(),
            CollectionField::new('images', 'Images')
                ->setEntryType(ImagesType::class)
        ];
    }


}

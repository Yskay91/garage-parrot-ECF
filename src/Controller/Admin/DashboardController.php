<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Entity\User;
use App\Entity\Hours;
use App\Entity\Garage;
use App\Entity\Images;
use App\Entity\Reviews;
use App\Entity\Messages;
use App\Entity\Services;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin.index')]
    public function index(): Response
    {

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage Parrot - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Voir le site public', 'fas fa-globe', '/');
        if($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::section('Gestion du garage');
            yield MenuItem::linkToCrud('Coordonnées', 'fas fa-address-book', Garage::class);
            yield MenuItem::linkToCrud('Horaire', 'fas fa-clock', Hours::class);
            yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);

            yield MenuItem::section('Contact/avis');
            yield MenuItem::linkToCrud('Demande de contact', 'fas fa-envelope', Messages::class);
        }

        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToUrl('Modifier un mot de passe', 'fas fa-lock', '/liste-employes');
        yield MenuItem::section('');
        yield MenuItem::linkToCrud('Annonces', 'fas fa-car', Cars::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-wrench', Services::class);
        yield MenuItem::linkToCrud('Avis', 'fas fa-star', Reviews::class);
        yield MenuItem::section('');
        yield MenuItem::linkToLogout('Se déconnecter', 'fa fa-xmark');
    }
}

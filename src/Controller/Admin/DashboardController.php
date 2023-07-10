<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Entity\Garage;
use App\Entity\Messages;
use App\Entity\Reviews;
use App\Entity\Services;
use App\Entity\User;
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
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Annonces', 'fas fa-car', Cars::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-wrench', Services::class);
        yield MenuItem::linkToCrud('Demande de contact', 'fas fa-envelope', Messages::class);
        yield MenuItem::linkToCrud('Avis', 'fas fa-star', Reviews::class);
        yield MenuItem::linkToCrud('Coordonnées', 'fas fa-address-book', Garage::class);
    }
}

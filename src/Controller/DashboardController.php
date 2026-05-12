<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Entity\Personne;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion Peintures')
            ->setFaviconPath('favicon.ico');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::section('Catalogue');
        yield MenuItem::linkToCrud('Peintures',   'fa fa-paint-brush', Peinture::class);
        yield MenuItem::linkToCrud('Catégories',  'fa fa-tags',        Categorie::class);
        yield MenuItem::section('Interactions');
        yield MenuItem::linkToCrud('Commentaires','fa fa-comments',    Commentaire::class);
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Personnes',   'fa fa-user',        Personne::class);
        yield MenuItem::linkToCrud('Utilisateurs','fa fa-users',       User::class);
    }
}

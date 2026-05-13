<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractDashboardController
{
    #[AdminDashboard(routePath: '/admin', routeName: 'admin')]
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
        yield MenuItem::linkTo(PeintureCrudController::class, 'Peintures', 'fa fa-paint-brush');
        yield MenuItem::linkTo(CategorieCrudController::class, 'Catégories', 'fa fa-tags');
        yield MenuItem::section('Interactions');
        yield MenuItem::linkTo(CommentaireCrudController::class, 'Commentaires', 'fa fa-comments');
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkTo(PersonneCrudController::class, 'Personnes', 'fa fa-user');
        yield MenuItem::linkTo(UserCrudController::class, 'Utilisateurs', 'fa fa-users');
    }
}

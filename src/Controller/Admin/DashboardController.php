<?php

namespace App\Controller\Admin;

use App\Entity\Pizza;
use App\Entity\Basket;
use App\Entity\Ingredient;
use App\Entity\PizzaIngredients;
use App\Controller\Admin\PizzaCrudController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ArticleCrudController;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(PizzaCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Back to HOME', 'fas fa-list', 'homepage');
        yield MenuItem::linkToCrud('Pizza', 'fas fa-list', Pizza::class);
        yield MenuItem::linkToCrud('Ingredient', 'fas fa-list', Ingredient::class);
        yield MenuItem::linkToCrud('Pizza\'s ingredients', 'fas fa-list', PizzaIngredients::class);
        // yield MenuItem::linkToCrud('Basket', 'fas fa-list', Basket::class);

    }
}

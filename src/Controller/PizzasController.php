<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzasController extends AbstractController
{
    #[Route('/pizzas', name: 'pizzas')]
    public function index(): Response
    {
        return $this->render('pizzas/index.html.twig', [
            'controller_name' => 'PizzasController',
        ]);
    }
}

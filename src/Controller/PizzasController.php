<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PizzasController extends AbstractController
{
    #[Route('/pizzas', name: 'pizzas')]
    public function index(Environment $twig, PizzaRepository $pizzaRepository): Response
    {
        return new Response($twig->render('pizzas/index.html.twig', [
            'pizzas' => $pizzaRepository->findAll(),
        ]));
    }

    #[Route('/pizza/{id}', name: 'pizza')]
    public function aboutPizza(Environment $twig, Pizza $pizza, 
        PizzaRepository $pizzaRepository): Response
    {
        return new Response($twig->render('pizzas/aboutPizza.html.twig', [
            'pizza' => $pizza,
        ]));
    }

}

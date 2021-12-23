<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Entity\Ingredient;
use App\Entity\PizzaIngredients;
use App\Repository\PizzaRepository;
use App\Repository\IngredientRepository;
use App\Repository\PizzaIngredientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PizzasController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(
        Request $request,
        Environment $twig, 
        PizzaRepository $pizzaRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $pizzaRepository->getPizzaPaginator($offset);
        return new Response(
            $twig->render(
                'pizzas/index.html.twig', [
                    'pizzas' => $paginator, 
                    'previous' => $offset - PizzaRepository::PAGINATOR_PER_PAGE, 
                    'next' => min(count($paginator), $offset + PizzaRepository::PAGINATOR_PER_PAGE),
                ]
            )
        );
        // return new Response($twig->render('pizzas/index.html.twig', [
        //     'pizzas' => $pizzaRepository->findAll(),
        // ]));
    }

    #[Route('/pizza/{id}', name: 'pizza')]
    public function aboutPizza(Environment $twig, Pizza $pizza, 
        // PizzaRepository $pizzaRepository,
        // IngredientRepository $ingredientRepository, 
        PizzaIngredientsRepository $pizzaIngredientsRepository): Response
    {
        return new Response($twig->render('pizzas/aboutPizza.html.twig', [
            'pizza' => $pizza,
            'pizzaIngredients' => $pizzaIngredientsRepository->findBy(['pizza' => $pizza->getId()]),
        ]));
    }

}

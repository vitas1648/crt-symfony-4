<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class IngredientsController extends AbstractController
{
    #[Route('/ingredients', name: 'ingredients')]
    public function index(Environment $twig, IngredientRepository $ingredientRepository): Response
    {
        return new Response($twig->render('ingredients/index.html.twig', [
            'ingredients' => $ingredientRepository->findAll(),
        ]));
//        return $this->render('ingredients/index.html.twig', [
//            'controller_name' => 'IngredientsController',
//        ]);
    }
}

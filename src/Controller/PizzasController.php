<?php

namespace App\Controller;

use App\Entity\Pizza;
use Twig\Environment;
use App\Entity\Basket;
use App\Entity\Ingredient;
// use Symfony\Component\Form\Forms;
use App\Entity\PizzaIngredients;
use App\Form\BasketAddPizzaType;
use App\Repository\PizzaRepository;
use App\Repository\IngredientRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PizzaIngredientsRepository;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

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
        $data = [];
        foreach ($paginator as $item) 
        {
            $basket = new Basket();
            $basket->setQuantity(1);
            $basket->setPizza($item);
            $form = $this->createForm(BasketAddPizzaType::class, $basket);
            $data[] = ['pizza' => $item, 'form' => $form->createView(),];
            $request = Request::createFromGlobals();
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $formData = $form->getData();
                return $this->redirectToRoute('basket_add', [
                    'quantity' => $formData->getQuantity(),
                    'pizza' => $formData->getPizza()->getId(),
                ]);
            }    
        } 
        return new Response(
            $twig->render(
                'pizzas/index.html.twig', [
                    'data' => $data,
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
        $basket = new Basket();
        $basket->setQuantity(1);
        $basket->setPizza($pizza);
        $form = $this->createForm(BasketAddPizzaType::class, $basket);
        $request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $formData = $form->getData();
            return $this->redirectToRoute('basket_add', [
                'quantity' => $formData->getQuantity(),
                'pizza' => $formData->getPizza()->getId(),
            ]);
        }    

        return new Response($twig->render('pizzas/aboutPizza.html.twig', [
            'pizza' => $pizza,
            'form' => $form->createView(),
            'pizzaIngredients' => $pizzaIngredientsRepository->findBy([
                'pizza' => $pizza->getId()]),
        ]));
    }

}

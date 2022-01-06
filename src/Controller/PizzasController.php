<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Entity\Basket;
use App\Form\BasketAddPizzaType;
use App\Repository\PizzaRepository;
use App\Service\Basket\BasketService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PizzasController extends AbstractController
{
    private $pizzaRepository;
    private $basketService;

    public function __construct(
        PizzaRepository $pizzaRepository,
        BasketService $basketService,
    ) {
        $this->pizzaRepository = $pizzaRepository;
        $this->basketService = $basketService;
    }

    #[Route('/', name: 'homepage')]
    public function index(Request $request): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $this->pizzaRepository->getPizzaPaginator($offset);
        $formsView = [];
        foreach ($paginator as $item) {
            $basket = new Basket($item);
            $form = $this->createForm(BasketAddPizzaType::class, $basket);
            $formsView[] = $form->createView();
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->basketService->addPizza(
                    $form->getData()->getPizza()->getId(),
                    $form->getData()->getQuantity()
                );
            }
        }
        return $this->render(
            'pizzas/index.html.twig',
            [
                'forms' => $formsView,
                'pizzas' => $paginator,
                'previous' => $offset - PizzaRepository::PAGINATOR_PER_PAGE,
                'next' => min(count($paginator), $offset + PizzaRepository::PAGINATOR_PER_PAGE),
            ]
        );
    }

    #[Route('/pizza/{id}', name: 'pizza')]
    public function aboutPizza(
        Request $request,
        Pizza $pizza,
    ): Response {
        $basket = new Basket($pizza);
        $form = $this->createForm(BasketAddPizzaType::class, $basket);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->basketService->addPizza(
                $form->getData()->getPizza()->getId(),
                $form->getData()->getQuantity()
            );
        }

        return $this->render('pizzas/aboutPizza.html.twig', [
            'pizza' => $pizza,
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Form\BasketEditPizzaType;
// use App\Repository\BasketRepository;
// use App\Service\Basket\BasketService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasketController extends AbstractController
{
    private $basketService;
    private $basketRepository;
    // private $em;

    public function __construct(
        // BasketService $basketService,
        // BasketRepository $basketRepository,
        // EntityManagerInterface $em,
    )
    {
        // $this->basketService = $basketService;
        // $this->basketRepository = $basketRepository;
        // $this->em = $em;
    }

    #[Route('/basket', name: 'basket')]
    public function index(
        Request $request,
    ): Response {
        $basket = $this->basketRepository->findBy([], ['id' => 'ASC']);
        $formsView = [];
        foreach ($basket as $item) {
            $form = $this->createForm(BasketEditPizzaType::class, $item);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->basketService->editPizza(
                    $form->getData()->getPizza()->getId(),
                    $form->getData()->getQuantity()
                );
            }
            $formsView[] = $form->createView();
        }
        [$quantity, $amount] = $this->basketService->calculate();
        return $this->render('basket/basket.html.twig', [
            'quantity' => $quantity,
            'amount' => $amount,
            'forms' => $formsView,
        ]);
    }

    #[Route('basket/clear', name: 'basket_clear')]
    public function clear(): RedirectResponse
    {
        $this->basketService->clear();
        return $this->redirectToRoute('homepage');
    }
}

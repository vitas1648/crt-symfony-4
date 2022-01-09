<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\BasketAddPizzaType;
use App\Repository\PizzaRepository;
use App\Service\Basket\BasketService;
use App\Service\Booking\BookingService;
use App\Service\Customer\CustomerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PizzasController extends AbstractController
{
    private PizzaRepository $pizzaRepository;
    private BasketService $basketService;
    private CustomerService $customerService;
    private BookingService $bookingService;

    public function __construct(
        PizzaRepository $pizzaRepository,
        BasketService $basketService,
        CustomerService $customerService,
        BookingService $bookingService,
    ) {
        $this->pizzaRepository = $pizzaRepository;
        $this->basketService = $basketService;
        $this->customerService = $customerService;
        $this->bookingService = $bookingService;
    }

    #[Route('/', name: 'homepage')]
    public function index(
        Request $request,
        SessionInterface $session,
    ): Response {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $this->pizzaRepository->getPizzaPaginator($offset);
        $formsView = [];
        foreach ($paginator as $item) {
            $basket = $this->basketService->createBasket($item);
            $form = $this->createForm(BasketAddPizzaType::class, $basket);
            $formsView[] = $form->createView();
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $customer = $this->customerService->addCustomerBySession($session->getId());
                $booking = $this->bookingService->addByCustomerId($customer->getId());
                $this->basketService->addPizza(
                    $form->getData()->getPizza()->getId(),
                    $form->getData()->getQuantity(),
                    $booking->getId()
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
        SessionInterface $session,
    ): Response {
        $basket = $this->basketService->createBasket($pizza);
        $form = $this->createForm(BasketAddPizzaType::class, $basket);
        // $message = new BasketMessage($pizza->getId(), 1, $session->getId());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $this->customerService->addCustomerBySession($session->getId());
            $booking = $this->bookingService->addByCustomerId($customer->getId());
            $this->basketService->addPizza(
                $form->getData()->getPizza()->getId(),
                $form->getData()->getQuantity(),
                $booking->getId()
            );
        }
        return $this->render('pizzas/aboutPizza.html.twig', [
            'pizza' => $pizza,
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Entity\Basket;
use App\Entity\User;
use App\Form\BasketAddPizzaType;
use App\Form\BasketMessageType;
use App\Message\BasketMessage;
use App\Repository\PizzaRepository;
use App\Service\Basket\BasketService;
use App\Service\User\UserService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
            $basket = new Basket();
            $basket->setPizza($item)->setQuantity(1);
            $form = $this->createForm(BasketAddPizzaType::class, $basket);
            $formsView[] = $form->createView();
            $form->handleRequest($request);
            // if ($form->isSubmitted() && $form->isValid()) {
            //     $this->basketService->addPizza(
            //         $form->getData()->getPizza()->getId(),
            //         $form->getData()->getQuantity()
            //     );
            // }
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
        UserService $userService,
        EntityManagerInterface $em,
    ): Response {

        $message = new BasketMessage($pizza->getId(), 1, $session->getId());
        // $userId = $userService->getIdBySession($session->getId());
        // if (is_null($userId)) {
        // }
        // $basket = new Basket($pizza);
        // $form = $this->createForm(BasketAddPizzaType::class, $basket);
        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $this->basketService->addPizza(
        //         $form->getData()->getPizza()->getId(),
        //         $form->getData()->getQuantity()
        //     );
        // }

        return $this->render('pizzas/aboutPizza.html.twig', [
            'pizza' => $pizza,
            // 'form' => $form->createView(),
        ]);
    }
}

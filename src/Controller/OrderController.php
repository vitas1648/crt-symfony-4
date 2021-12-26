<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use Twig\Environment;
use App\Repository\BasketRepository;
use App\Repository\PizzaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'order')]
    public function order(
        Environment $twig, 
        BasketRepository $basketRepository,
        PizzaRepository $pizzaRepository,
        Request $request): Response
    {
        $order = new Order;
        $basket = $basketRepository->findAll();
        // dump($basket);
        $amount = 0;
        $count = 0;
        foreach ($basket as $item) 
        {
            $pizza = $pizzaRepository->findOneBy(['id' => $item->getPizza()->getId()]);
            $item->setPizza($pizza);
            $amount += $pizza->getPrice() * $item->getQuantity();
            $count += $item->getQuantity();
        }
        $order->setAmount($amount);

        $form = $this->createForm(OrderType::class, $order);

        return new Response($twig->render('order/order.html.twig', [
            'basket' => $basket,
            'amount' => $amount,
            'count' => $count,
            'form' => $form->createView(),
        ]));
    }
}

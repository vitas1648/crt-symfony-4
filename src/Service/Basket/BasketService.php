<?php

namespace App\Service\Basket;

// use App\Entity\Basket;
use App\Repository\PizzaRepository;
// use App\Repository\BasketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class BasketService
{
    // private PizzaRepository $pizzaRepository;
    // private BasketRepository $basketRepository;
    // private EntityManagerInterface $em;

    // public function __construct(
    //     PizzaRepository $pizzaRepository,
    //     BasketRepository $basketRepository,
    //     EntityManagerInterface $em,
    // ) {
    //     $this->pizzaRepository = $pizzaRepository;
    //     $this->basketRepository = $basketRepository;
    //     $this->em = $em;
    // }

    // public function addPizza(int $pizzaId, int $quantity): void
    // {
    //     $basket = $this->basketRepository->findOneBy(['pizza' => $pizzaId]);
    //     if (is_null($basket)) {
    //         $pizza = $this->pizzaRepository->findOneBy(['id' => $pizzaId]);
    //         $basket = new Basket($pizza, $quantity);
    //     } else {
    //         $basket->setQuantity($basket->getQuantity() + $quantity);
    //     }
    //     $this->em->persist($basket);
    //     $this->em->flush();
    //     return;
    // }

    // public function editPizza(int $pizzaId, int $quantity): void
    // {
    //     $basket = $this->basketRepository->findOneBy(['pizza' => $pizzaId]);
    //     if ($quantity > 0) {
    //         $basket->setQuantity($quantity);
    //         $this->em->persist($basket);
    //     } else {
    //         $this->em->remove($basket);
    //     }
    //     $this->em->flush();
    //     return;
    // }

    // public function calculate(): array
    // {
    //     $quantity = 0;
    //     $amount = 0;
    //     $basket = $this->basketRepository->findBy([]);
    //     foreach ($basket as $pizza) {
    //         $quantity += $pizza->getQuantity();
    //         $amount += $pizza->getQuantity() * $pizza->getPizza()->getPrice();
    //     }
    //     return [$quantity, $amount];
    // }

    // public function clear(): void
    // {
    //     $basket = $this->basketRepository->findBy([]);
    //     foreach ($basket as $item) {
    //         $this->em->remove($item);
    //     }
    //     $this->em->flush();
    // }
}

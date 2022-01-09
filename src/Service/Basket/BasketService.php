<?php

namespace App\Service\Basket;

use App\Entity\Basket;
use App\Entity\Pizza;
use App\Repository\BookingRepository;
use App\Repository\BasketRepository;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;

class BasketService
{
    private PizzaRepository $pizzaRepository;
    private BookingRepository $bookingRepository;
    private BasketRepository $basketRepository;
    private EntityManagerInterface $em;

    public function __construct(
        PizzaRepository $pizzaRepository,
        BookingRepository $bookingRepository,
        BasketRepository $basketRepository,
        EntityManagerInterface $em,
    ) {
        $this->pizzaRepository = $pizzaRepository;
        $this->bookingRepository = $bookingRepository;
        $this->basketRepository = $basketRepository;
        $this->em = $em;
    }

    public function addPizza(int $pizzaId, int $quantity, int $bookingId): void
    {
        $basket = $this->basketRepository->findOneBy([
            'pizza' => $pizzaId,
            'booking' => $bookingId,
        ]);
        if (is_null($basket)) {
            $pizza = $this->pizzaRepository->findOneBy(['id' => $pizzaId]);
            $booking = $this->bookingRepository->findOneBy(['id' => $bookingId]);
            $basket = (new Basket())
                ->setPizza($pizza)
                ->setQuantity($quantity)
                ->setBooking($booking);
        } else {
            $basket->setQuantity($basket->getQuantity() + $quantity);
        }
        $this->em->persist($basket);
        $this->em->flush();
        return;
    }

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

    public function createBasket(Pizza $pizza): Basket
    {
        $basket = new Basket();
        $basket->setPizza($pizza)->setQuantity(1);
        return $basket;
    }

    public function addBasket(Basket $basket): Basket
    {
        if (is_null($basket->getId())) {
            $this->em->persist($basket);
            $this->em->flush();
        }
        return $basket;
    }
}

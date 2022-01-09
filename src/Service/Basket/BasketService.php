<?php

namespace App\Service\Basket;

use App\Entity\Basket;
use App\Entity\Pizza;
use App\Repository\BookingRepository;
use App\Repository\BasketRepository;
use App\Repository\PizzaRepository;
use App\Service\Booking\BookingService;
use Doctrine\ORM\EntityManagerInterface;

class BasketService
{
    private PizzaRepository $pizzaRepository;
    private BookingRepository $bookingRepository;
    private BasketRepository $basketRepository;
    private EntityManagerInterface $em;
    private BookingService $bookingService;

    public function __construct(
        PizzaRepository $pizzaRepository,
        BookingRepository $bookingRepository,
        BasketRepository $basketRepository,
        EntityManagerInterface $em,
        BookingService $bookingService,
    ) {
        $this->pizzaRepository = $pizzaRepository;
        $this->bookingRepository = $bookingRepository;
        $this->basketRepository = $basketRepository;
        $this->em = $em;
        $this->bookingService = $bookingService;
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

    public function editPizza(int $pizzaId, int $quantity, int $bookingId): void
    {
        $basket = $this->basketRepository->findOneBy([
            'pizza' => $pizzaId,
            'booking' => $bookingId,
        ]);
        if ($quantity > 0) {
            $basket->setQuantity($quantity);
            $this->em->persist($basket);
        } else {
            $this->em->remove($basket);
        }
        $this->em->flush();
        return;
    }

    public function calculate(string $sessionId): int
    {
        $amount = 0;
        $basket = $this->getBySessionId($sessionId);
        if (!is_null($basket)) {
            foreach ($basket as $pizza) {
                $amount += $pizza->getQuantity() * $pizza->getPizza()->getPrice();
            }
        }
        return $amount;
    }

    public function clear($sessionId): void
    {
        $basket = $this->getBySessionId($sessionId);
        if (!is_null($basket)) {

            foreach ($basket as $item) {
                $this->em->remove($item);
            }
            $this->em->flush();
        }
    }

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

    public function getByBookingId(int $bookingId): array
    {
        return $this->basketRepository->findBy(['booking' => $bookingId], ['id' => 'ASC']);
    }

    public function getByCustomerId(int $customerId): array
    {
        $booking = $this->bookingService->getByCustomerId($customerId);
        return $this->getByBookingId($booking->getId());
    }
    public function getBySessionId(string $sessionId): ?array
    {
        $booking = $this->bookingService->getBySessionId($sessionId);
        if (!is_null($booking)) {
            return $this->getByBookingId($booking->getId());
        }
        return null;
    }
}

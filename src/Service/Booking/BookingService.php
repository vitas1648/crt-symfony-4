<?php

namespace App\Service\Booking;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookingService
{
    private BookingRepository $bookingRepository;
    private EntityManagerInterface $em;
    private CustomerRepository $customerRepository;

    public function __construct(
        BookingRepository $bookingRepository,
        EntityManagerInterface $em,
        CustomerRepository $customerRepository,
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->em = $em;
        $this->customerRepository = $customerRepository;
    }

    public function addByCustomerId(int $customerId): Booking
    {
        $booking = $this->bookingRepository->findOneBy(['customer' => $customerId]);
        if (is_null($booking)) {
            $customer = $this->customerRepository->findOneBy(['id' => $customerId]);
            $booking = (new Booking())
                ->setCustomer($customer)
                ->setCreatedAt(new \DateTimeImmutable())
                ->setAmount(0);
            $this->em->persist($booking);
            $this->em->flush();
        }
        return $booking;
    }

    public function getAmountBySessionId(string $sessionId): int
    {
        $customer = $this->customerRepository->findOneBy(['session' => $sessionId]);
        $booking = $this->bookingRepository->findOneBy(['customer' => $customer->getId()]);
        return $booking->getAmount();
    }
}

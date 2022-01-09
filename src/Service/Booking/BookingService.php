<?php

namespace App\Service\Booking;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use App\Repository\CustomerRepository;
use App\Service\Customer\CustomerService;
use Doctrine\ORM\EntityManagerInterface;

class BookingService
{
    private BookingRepository $bookingRepository;
    private EntityManagerInterface $em;
    private CustomerRepository $customerRepository;
    private CustomerService $customerService;

    public function __construct(
        BookingRepository $bookingRepository,
        EntityManagerInterface $em,
        CustomerRepository $customerRepository,
        CustomerService $customerService,
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->em = $em;
        $this->customerRepository = $customerRepository;
        $this->customerService = $customerService;
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

    public function getBySessionId(string $sessionId): ?Booking
    {
        $customer = $this->customerService->checkBySession($sessionId);
        if (!is_null($customer)) {
            $booking = $this->getByCustomerId($customer->getId());
            return $booking;
        }
        return null;
    }

    public function getByCustomerId(int $customerId): Booking
    {
        $booking = $this->bookingRepository->findOneBy(['customer' => $customerId]);
        return $booking;
    }

    public function setAmountBySessionId(int $amount, string $sessionId): ?Booking
    {
        $booking = $this->getBySessionId($sessionId);
        if (!is_null($booking)) {
            $booking->setAmount($amount);
            $this->em->persist($booking);
            $this->em->flush();
            return $booking;
        }
        return null;
    }
}

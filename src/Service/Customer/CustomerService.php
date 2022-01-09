<?php

namespace App\Service\Customer;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;

class CustomerService
{
    private $customerRepository;
    private $em;

    public function __construct(
        CustomerRepository $customerRepository,
        EntityManagerInterface $em,
    ) {
        $this->customerRepository = $customerRepository;
        $this->em = $em;
    }

    public function getIdBySession(?string $sessionId): ?int
    {
        if (!is_null($sessionId)) {
            $customer = $this->checkBySession($sessionId);
            if (!is_null($customer)) {
                return $customer->getId();
            }
        }
        return null;
    }

    public function checkBySession(?string $sessionId): ?Customer
    {
        if (!is_null($sessionId)) {
            return $this->customerRepository->findOneBy(['sessionId' => $sessionId]);
        }
        return null;
    }

    public function addCustomerBySession(?string $sessionId): Customer
    {
        $customer = $this->checkBySession($sessionId);
        if (is_null($customer)) {
            $customer = (new Customer())
                ->setPhone('tmp' . uniqid())
                ->setSessionId($sessionId);
            $this->em->persist($customer);
            $this->em->flush();
        }
        return $customer;
    }
}

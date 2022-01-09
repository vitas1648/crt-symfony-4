<?php

namespace App\Controller;

use App\Form\BasketEditPizzaType;
use App\Repository\BasketRepository;
use App\Service\Basket\BasketService;
use App\Service\Booking\BookingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketController extends AbstractController
{
    private $basketService;
    private $basketRepository;
    private BookingService $bookingService;
    // private $em;

    public function __construct(
        BasketService $basketService,
        BasketRepository $basketRepository,
        BookingService $bookingService,
        // EntityManagerInterface $em,
    ) {
        $this->basketService = $basketService;
        $this->basketRepository = $basketRepository;
        $this->bookingService = $bookingService;
        // $this->em = $em;
    }

    #[Route('/basket', name: 'basket')]
    public function index(
        Request $request,
        SessionInterface $session,
    ): Response {
        $basket = $this->basketService->getBySessionId($session->getId());
        $formsView = [];
        if (!is_null($basket)) {
            foreach ($basket as $item) {
                $form = $this->createForm(BasketEditPizzaType::class, $item);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $booking = $this->bookingService->getBySessionId($session->getId());
                    $this->basketService->editPizza(
                        $form->getData()->getPizza()->getId(),
                        $form->getData()->getQuantity(),
                        $booking->getId()
                    );
                    if (1 > $form->getData()->getQuantity()) {
                        // sleep(2);
                        unset($form);
                        $this->redirectToRoute('basket');
                    }
                }
                if (isset($form)) {
                    $formsView[] = $form->createView();
                }
            }
        }
        $amount = $this->basketService->calculate($session->getId());
        $this->bookingService->setAmountBySessionId($amount, $session->getId());
        return $this->render('basket/basket.html.twig', [
            'amount' => $amount,
            'forms' => $formsView,
        ]);
    }

    #[Route('basket/clear', name: 'basket_clear')]
    public function clear(
        SessionInterface $session,
    ): RedirectResponse {
        $this->basketService->clear($session->getId());
        return $this->redirectToRoute('homepage');
    }
}

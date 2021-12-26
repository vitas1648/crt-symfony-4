<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Basket;
use App\Form\BasketClearType;
use App\Form\BasketEditPizzaType;
use App\Repository\PizzaRepository;
use App\Repository\BasketRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'basket')]
    public function index(Environment $twig,
        Request $request,
        PizzaRepository $pizzaRepository,
        BasketRepository $basketRepository): Response
    {
        $basket = $basketRepository->findAll();
        $data = [];
        foreach ($basket as $item) 
        {
            $pizza = $pizzaRepository->findOneBy(['id' => (string)$item->getPizza()->getId()]);
            $item->setPizza($pizza);
        }
        return new Response($twig->render('basket/basket.html.twig', [
            'basket' => $basket,
        ]));
    }

    #[Route('basket/add', name: 'basket_add')]
    public function add(Environment $twig,
        Request $request,
        PizzaRepository $pizzaRepository,
        BasketRepository $basketRepository): RedirectResponse
    {
        $id = $request->query->get('pizza');
        $quantity = $request->query->get('quantity');
        $entityManager = $this->getDoctrine()->getManager();
        if ($basketItem = $basketRepository->findOneBy(['pizza' => $id]))
        {
            $basketItem->setQuantity($basketItem->getQuantity() + $quantity);
        } else {
            $basketItem = new Basket();
            $basketItem->setQuantity($quantity);
        }
        $basketItem->setPizza($pizzaRepository->findOneBy(['id' => $id]));
        $entityManager->persist($basketItem);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    #[Route('basket/inc', name: 'basket_inc')]
    public function inc(
        Request $request,
        BasketRepository $basketRepository,
    ):RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $id = $request->query->get('id');
        $basketItem = $basketRepository->findOneBy(['pizza' => $id]);
        $basketItem->setQuantity($basketItem->getQuantity() + 1);
        $entityManager->persist($basketItem);
        $entityManager->flush();

        return $this->redirectToRoute('basket');
    }

    #[Route('basket/dec', name: 'basket_dec')]
    public function dec(
        Request $request,
        BasketRepository $basketRepository,
    ):RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $id = $request->query->get('id');
        $basketItem = $basketRepository->findOneBy(['pizza' => $id]);
        if (1 < $basketItem->getQuantity())
        {
            $basketItem->setQuantity($basketItem->getQuantity() - 1);
            $entityManager->persist($basketItem);
        } 
        else 
        {
            $entityManager->remove($basketItem);
        }
        $entityManager->flush();

        return $this->redirectToRoute('basket');
    }

    #[Route('basket/clear', name:'basket_clear')]
    public function clear(
        BasketRepository $basketRepository,
    ): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $basket = $basketRepository->findAll();
        foreach ($basket as $item) 
        {
            $entityManager->remove($item);
        }
        $entityManager->flush();
        return $this->redirectToRoute('homepage');
    }
}

<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Basket;
use App\Form\BasketClearType;
use App\Form\BasketEditPizzaType;
use App\Repository\PizzaRepository;
use App\Repository\BasketRepository;
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
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($basket as $item)
        {
            $pizza = $pizzaRepository->findOneBy(['id' => (string)$item->getPizza()->getId()]);
            $item->setPizza($pizza);
            $form = $this->createForm(BasketEditPizzaType::class, $item);
            $data[] = ['pizza' => $item, 'form' => $form->createView()];
            $form->handleRequest($request);
            if ($form->isSubmitted()) 
            {
                $entityManager->remove($item);
                $entityManager->flush();
                return $this->redirectToRoute('basket', [
                ]);
            }    
        }
        $formClear = $this->createForm(BasketClearType::class);
        $formClear->handleRequest($request);
        if ($formClear->isSubmitted()) 
        {
            foreach ($basket as $item)
            {
                $entityManager->remove($item);
            }
            $entityManager->flush();
            return $this->redirectToRoute('basket', [
            ]);
    }
        return new Response($twig->render('basket/basket.html.twig', [
            'basket' => $data,
            'formClear' => $formClear->createView(),
        ]));
    }

    #[Route('basket/add', name: 'basket_add')]
    public function add(Environment $twig,
        Request $request,
        PizzaRepository $pizzaRepository,
        BasketRepository $basketRepository): RedirectResponse
    {
        // $pizzaRepozitory = new PizzaRepository();
        $id = $request->query->get('pizza');
        $quantity = $request->query->get('quantity');
        $entityManager = $this->getDoctrine()->getManager();
        if ($basketItem = $basketRepository->findOneBy(['pizza' => $id]))
        {
            $basketItem->setQuantity($basketItem->getQuantity() + $quantity);
        } else {
            $basketItem = new Basket();
            $basketItem->setQuantity($quantity);
            // $lastId = $basketRepository->findOneBy([], ['id' => 'DESC']);
            // $basketItem->setId();
        }
        $basketItem->setPizza($pizzaRepository->findOneBy(['id' => $id]));
        $entityManager->persist($basketItem);
        $entityManager->flush();
        // $basketUpdate = $basketRepository->findAll();
        // dump($basketUpdate);

        return $this->redirectToRoute('homepage');

        // dump($basketItem);
        // return new Response($twig->render('basket/basket_add.html.twig', [
        //     'pizza' => $basketItem,
        // ]));
    }
}

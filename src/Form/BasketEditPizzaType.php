<?php

namespace App\Form;

use App\Entity\Pizza;
use App\Entity\Basket;
use App\Controller\BasketController;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\EventSubscriber\NumberFieldEventSubscriber;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasketEditPizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity', IntegerType::class, ['label' => 'Количество'])
            ->add('pizza', EntityType::class, [
                'class' => Pizza::class, 
                'choice_label' => 'name',
                'label' => ' ', 
                'attr' => ['hidden' => 'true']])
            ->addEventSubscriber(new NumberFieldEventSubscriber)
                // ->add('submit', SubmitType::class, ['label' => 'Удалмть',])
            // ->setAction(AbstractController::generateUrl('basket_add'))
            // ->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) {
                // $formData = $event->getData();
                // $url = $this->router->generate('basket_add');
                // return new RedirectResponse($url);
                // $basketController = new BasketController;
                // $basketController->add($event);
            // })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Basket::class,
        ]);
    }
}

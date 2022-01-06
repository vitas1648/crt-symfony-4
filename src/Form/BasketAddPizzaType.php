<?php

namespace App\Form;

use App\Entity\Pizza;
use App\Entity\Basket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BasketAddPizzaType extends AbstractType
{
    private $formCount;

    public function __construct()
    {
        $this->formCount = 0;
    }

    public function getBlockPrefix()
    {
        return parent::getBlockPrefix() . '_' . $this->formCount;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        ++$this->formCount;
        $builder
            ->add('quantity', IntegerType::class, ['label' => 'Количество'])
            ->add('pizza', EntityType::class, [
                'class' => Pizza::class,
                'choice_label' => 'name',
                'label' => ' ',
                'attr' => ['hidden' => 'true']
            ])
            ->add('submit', SubmitType::class, ['label' => 'Добавить',]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Basket::class,
        ]);
    }
}

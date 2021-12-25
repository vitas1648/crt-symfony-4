<?php

namespace App\Controller\Admin;

use App\Entity\Basket;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BasketCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Basket::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('pizza'),
            NumberField::new('quantity'),
            // TextField::new('title'),
            // TextEditorField::new('description'),
        ];
    }
    
}

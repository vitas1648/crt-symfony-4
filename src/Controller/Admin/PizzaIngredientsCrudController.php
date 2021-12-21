<?php

namespace App\Controller\Admin;

use App\Entity\PizzaIngredients;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PizzaIngredientsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PizzaIngredients::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('pizza'),
            AssociationField::new('ingredient'),
            // TextEditorField::new('description'),
        ];
    }
}
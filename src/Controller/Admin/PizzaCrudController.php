<?php

namespace App\Controller\Admin;

use App\Entity\Pizza;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PizzaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pizza::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            idField::new('id')->hideOnForm(),
            TextField::new('name'),
            NumberField::new('price'),
            TextField::new('description'),
            VichImageField::new('imageFile')->onlyOnForms(),
            VichImageField::new('image')->hideOnForm(),
        ];
    }
}

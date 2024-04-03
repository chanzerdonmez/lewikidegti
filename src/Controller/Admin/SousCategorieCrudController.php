<?php

namespace App\Controller\Admin;

use App\Entity\SousCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SousCategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SousCategorie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre') // Champ d'entrée pour le nom de la sous-catégorie
                ->setLabel('Nom de la sous-catégorie') // Étiquette du champ
                ->setRequired(true), // Rendre le champ obligatoire si nécessaire
            AssociationField::new('categorie')
                ->setLabel('Catégorie')
                ->setRequired(true),
        ];
    }
}

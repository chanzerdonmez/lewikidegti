<?php
 
namespace App\Controller\Admin;
 
use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
 
class ArticleCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setFormThemes(['@EasyAdmin/crud/form_theme.html.twig', 'admin/articleForm2.html.twig']); // On ajoute un thème pour le formulaire
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextEditorField::new('contenu'),
            AssociationField::new('sousCategorie') // Champ pour sélectionner une sous-catégorie
                ->setLabel('Sous-catégorie')
                ->setRequired(true),
            DateTimeField::new('createdAt') // Ajout du champ createdAt
                ->setLabel('Date de création')
                ->setRequired(true), // Rendre le champ obligatoire
            BooleanField::new('isPrive') // Champ pour définir si l'article est privé ou non
                ->setLabel('Privé')
            // AssociationField::new('categorie') // Champ pour sélectionner une sous-catégorie
            //     ->setLabel('Catégorie')
            //     ->setRequired(true),
        ];
    }
}
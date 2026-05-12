<?php

namespace App\Controller\Admin;

use App\Entity\Peinture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PeintureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Peinture::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Nom', 'Nom'),
            NumberField::new('largeur', 'Largeur (cm)'),
            NumberField::new('Hauteur', 'Hauteur (cm)'),
            BooleanField::new('en_vente', 'En vente'),
            NumberField::new('prix', 'Prix (TND)'),
            DateTimeField::new('date_realisation', 'Date de réalisation'),
            TextareaField::new('description', 'Description')->hideOnIndex(),
            AssociationField::new('personne', 'Artiste'),
            AssociationField::new('categories', 'Catégories'),
        ];
    }
}

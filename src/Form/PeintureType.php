<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Peinture;
use App\Entity\Personne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeintureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'label' => 'Nom de la peinture',
                'attr'  => ['class' => 'form-control'],
            ])
            ->add('largeur', NumberType::class, [
                'label' => 'Largeur (cm)',
                'scale' => 2,
                'attr'  => ['class' => 'form-control'],
            ])
            ->add('Hauteur', NumberType::class, [
                'label' => 'Hauteur (cm)',
                'scale' => 2,
                'attr'  => ['class' => 'form-control'],
            ])
            ->add('en_vente', CheckboxType::class, [
                'label'    => 'En vente',
                'required' => false,
                'attr'     => ['class' => 'form-check-input'],
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix (TND)',
                'scale' => 2,
                'attr'  => ['class' => 'form-control'],
            ])
            ->add('date_realisation', DateTimeType::class, [
                'label'  => 'Date de réalisation',
                'widget' => 'single_text',
                'attr'   => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr'  => ['class' => 'form-control', 'rows' => 4],
            ])
            ->add('personne', EntityType::class, [
                'class'        => Personne::class,
                'choice_label' => '__toString',
                'label'        => 'Artiste',
                'attr'         => ['class' => 'form-select'],
            ])
            ->add('categories', EntityType::class, [
                'class'        => Categorie::class,
                'choice_label' => 'Designation',
                'multiple'     => true,
                'expanded'     => false,
                'label'        => 'Catégories',
                'attr'         => ['class' => 'form-select', 'size' => 5],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Peinture::class,
        ]);
    }
}

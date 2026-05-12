<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Personne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'label' => 'Nom',
                'attr'  => ['class' => 'form-control'],
            ])
            ->add('Contenu', TextareaType::class, [
                'label' => 'Contenu',
                'attr'  => ['class' => 'form-control', 'rows' => 5],
            ])
            ->add('Date', DateTimeType::class, [
                'label'  => 'Date',
                'widget' => 'single_text',
                'attr'   => ['class' => 'form-control'],
            ])
            ->add('personne', EntityType::class, [
                'class'        => Personne::class,
                'choice_label' => '__toString',
                'label'        => 'Personne',
                'attr'         => ['class' => 'form-select'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}

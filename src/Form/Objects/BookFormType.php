<?php

namespace App\Form\Objects;

use App\Entity\Objects\Book;
use App\Entity\Objects\Librairies;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('librairies', EntityType::class, [
                'class'         => Librairies::class,
                'label'         => 'Librairies',
                'choice_label'  => 'title',
                'required'      => false,
                'multiple'      => true,
                'expanded'      => true,
            ])
            ->add('author', TextType::class, [
                'label'     => 'Auteur',
                'required'  => false
            ])
            ->add('title', TextType::class, [
                'label'     => 'Titre',
                'required'  => false
            ])
            ->add('city', TextType::class, [
                'label'     => 'Ville',
                'required'  => false
            ])
            ->add('editor', TextType::class, [
                'label'     => 'Editeur',
                'required'  => false
            ])
            ->add('year', DateType::class, [
                'label'     => 'Année',
                'required'  => false,
                'placeholder' => [
                    'year'  => 'Year', 'month' => 'Month',
                ],
            ])
            ->add('quantity', TextType::class, [
                'label'     => 'Tome',
                'required'  => false
            ])
            ->add('pages', TextType::class, [
                'label'     => 'Pages',
                'required'  => false
            ])
            ->add('notice', TextareaType::class, [
                'label'     => 'Nota',
                'required'  => false
            ])
            ->add('rentNumber',IntegerType::class, [
                'label'     => 'N° Prêt',
                'required'  => false
            ])
            ->add('submit', SubmitType::class, [
                'label'     => 'Ajouter un ouvrage',
                'attr'      => [
                    'class' => 'btn-vodou my-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}

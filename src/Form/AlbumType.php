<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Genre;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('year')
            ->add('artist', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisissez un artiste',
                'query_builder' => function (EntityRepository $rep) {
                    return $rep->createQueryBuilder('a')
                    ->orderBy('a.name', 'ASC');
                },
            ])
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisissez un genre',
                'query_builder' => function (EntityRepository $rep) {
                    return $rep->createQueryBuilder('g')
                    ->orderBy('g.name', 'ASC');
                },
            ])
            ->add('submit', SubmitType::class)
            //->add('cover')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
            'cascade_validation' => true,
        ]);
    }
}

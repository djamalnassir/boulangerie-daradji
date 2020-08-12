<?php

namespace App\Form;

use App\Entity\ProduitFini;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProduitFiniType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('libelle')
            ->add('prixUnitaire')
            ->add('detailProduitFini')
            ->add('production', EntityType::class, [
                'class' => Production::class,
                'choice_label' => 'dateProduction',
                'placeholder' => 'Production'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitFini::class,
        ]);
    }
}

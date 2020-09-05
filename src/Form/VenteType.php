<?php

namespace App\Form;

use App\Entity\Vente;
use App\Entity\Client;
use App\Entity\ProduitFini;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'nom',
                'required' => false,
                'placeholder' => 'Choisir le client'
            ])
            ->add('produitFini', EntityType::class, [
                'class' => ProduitFini::class,
                'choice_label' => 'libelle',
                'required' => false,
                'placeholder' => 'Choisir le produit'
            ])
            ->add('quantite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vente::class,
        ]);
    }
}

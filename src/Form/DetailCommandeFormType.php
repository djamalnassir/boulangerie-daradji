<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\MatierePremiere;
use App\Entity\DetailCommande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailCommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            ->add('matiereP', EntityType::class, [
                'class' => MatierePremiere::class,
                'choice_label' => 'nom',
                'placeholder' => 'Matiere premiere'
            ])
            ->add('commande', EntityType::class, [
                'class' => Commande::class,
                'choice_label' => 'id',
                'required' => false,
                'placeholder' => 'Commande'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetailCommande::class,
        ]);
    }
}

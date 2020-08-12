<?php

namespace App\Form;

use App\Entity\Production;
use App\Entity\MatierePremiere;
use App\Entity\DetailProduction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailProductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matierePremiere', EntityType::class, [
                'class' => MatierePremiere::class,
                'choice_label' => 'nom',
                'placeholder' => 'Matiere premiere'
            ])
            ->add('quantite')
            ->add('production', EntityType::class, [
                'class' => Production::class,
                'choice_label' => 'id',
                'required' => false,
                'placeholder' => 'Matiere premiere'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetailProduction::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Appro;
use App\Entity\DetailAppro;
use App\Entity\MatierePremiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailApproType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            ->add('matierePremiere', EntityType::class, [
                'class' => MatierePremiere::class,
                'choice_label' => 'nom',
                'placeholder' => 'matierePremiere',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetailAppro::class,
        ]);
    }
}

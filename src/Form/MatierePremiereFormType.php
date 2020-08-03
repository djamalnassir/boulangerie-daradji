<?php

namespace App\Form;


use App\Entity\MagasinStock;
use App\Entity\MatierePremiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MatierePremiereFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('nom')
            ->add('magasinStock', EntityType::class, [
                'class' => MagasinStock::class,
                'choice_label' => 'nom',
                'placeholder' => 'Matiere Premiere'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MatierePremiere::class,
        ]);
    }
}

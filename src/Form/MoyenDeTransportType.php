<?php

namespace App\Form;

use App\Entity\MoyenDeTransport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoyenDeTransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Type')
            ->add('Num_ligne')
            ->add('Date_de_mise_en_circulations')
            ->add('Etat')
            ->add('Accessible_au_handicape')
            ->add('Prix_Achat')
            ->add('Poids')
            ->add('Longueur')
            ->add('Largeur')
            ->add('Energie')
            ->add('Nombre_de_place')
            ->add('depot')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MoyenDeTransport::class,
        ]);
    }
}

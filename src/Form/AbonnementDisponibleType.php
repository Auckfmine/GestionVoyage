<?php

namespace App\Form;

use App\Entity\AbonnementDisponible;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonnementDisponibleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descr')
            ->add('type')
            ->add('prix_mois')
            ->add('prix_semestre')
            ->add('prix_annuel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AbonnementDisponible::class,
        ]);
    }
}

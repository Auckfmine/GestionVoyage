<?php

namespace App\Form;

use App\Entity\Voyage;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref_voyage')
            ->add('ligne')
            ->add('date_depart',DateTimeType::class,['widget'=>'single_text'])
            ->add('date_arrive',DateTimeType::class,['widget'=>'single_text'])
            ->add('station_depart')
            ->add('Station_arrive')
            ->add('MoyenDeTransport')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}

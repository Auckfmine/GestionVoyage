<?php

namespace App\Form;

use App\Entity\Depot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Capacite',NumberType::class,[
                'attr'=>[
                    'placeholder'=>'Spécifier la capacité maximale',
                    'class'=> 'custom_class'
                ]
            ])
            ->add('Categorie',ChoiceType::class, [
                'choices' => [
                    'Bus'=>'Bus',
                    'Metro'=>'Metro',
                    'Train '=>'Train'
                ],])
            ->add('Localisation',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Spécifier la localisation du Depot',
                    'class'=> 'custom_class'
                ]
            ])
            ->add('Etat',ChoiceType::class, [
                'choices' => [
                    'En_marche'=>'En_marche',
                    'En_panne'=>'En_panne'

                ],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Depot::class,
        ]);
    }
}

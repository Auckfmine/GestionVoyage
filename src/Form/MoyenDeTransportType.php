<?php

namespace App\Form;

use App\Entity\MoyenDeTransport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class MoyenDeTransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Type',ChoiceType::class, [
                'choices' => [
                    'Bus'=>'Bus',
                    'Metro'=>'Metro',
                    'Train '=>'Train'
                ],])
            ->add('Num_ligne',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Spécifier le Numéro de ligne',
                    'class'=> 'custom_class'
                ]
            ])
            ->add('Date_de_mise_en_circulation')
            ->add('Etat')

            ->add('Accessible_au_handicape')
            ->add('Prix_Achat',MoneyType::class, array(
                'scale'=>2 ,
                'currency'=>false,
                'attr'=>[ 'placeholder'=>'Spécifier le Prix Achat']
                ))

            ->add('Poids',NumberType::class,[
                'attr'=>[
                    'placeholder'=>'Spécifier le Poids',
                    'class'=> 'custom_class'
                ]
            ])
            ->add('Longueur',NumberType::class,[
                'attr'=>[
                    'placeholder'=>'Spécifier la Longueur',
                    'class'=> 'custom_class'
                ]
            ])
            ->add('Largeur',NumberType::class,[
                'attr'=>[
                    'placeholder'=>'Spécifier la Largeur',
                    'class'=> 'custom_class'
                ]
            ])
            ->add('Energie',ChoiceType::class, [
                'choices' => [
                    'Essence'=>'Essence',
                    'Diesel'=>'Diesel',
                    'Electrique '=>'Electrique',
                    'Gaz '=>'Gaz'
                ],])
            ->add('Nombre_de_place')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MoyenDeTransport::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Reclamation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextareaType::class/*,
            ['attr'=>['class'=>'NameReclamation'],
                'label'=>"Name"
            ]
           */ )// <label>name</label> <input type="text>
            ->add('object')
            ->add('description')
            ->add('category',EntityType::class,['class'=>Category::class,
                'choice_label'=>'titre',
                'label'=>'Catégorie'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}

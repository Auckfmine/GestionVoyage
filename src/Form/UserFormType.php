<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name')
            ->add('last_name')
            ->add('email')
            ->add('number')
            ->add('username')
            ->add('password',PasswordType::class)
            ->add('role',ChoiceType::class, [
                'choices' => [
                    'CLIENT'=>'CLIENT',
                    'ADMIN'=>'ADMIN',
                    'RESPONSABLE_ABONNEMENT'=>'RESPONSABLE_ABONNEMENT',
                    'RESPONSABLE_RECLAMATION'=>'RESPONSABLE_RECLAMATION',
                    'RESPONSABLE_MDT'=>'RESPONSABLE_MDT',
                    'RESPONSABLE_VOYAGE'=>'RESPONSABLE_VOYAGE',
                    'RESPONSABLE_RESERVATION'=>'RESPONSABLE_RESERVATION',
                ],])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text'])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Enfant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnfantFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('isEmailValidate')
            ->add('Nom')
            ->add('Prenom')
            ->add('DateNaiss')
            ->add('responsable')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enfant::class,
        ]);
    }
}

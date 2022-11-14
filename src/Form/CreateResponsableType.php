<?php

namespace App\Form;


use App\Entity\Etudiant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Responsable;


class CreateResponsableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, array('label' => 'Numéro de rue'))
            ->add('prenom', TextType::class, array('label' => 'Numéro de rue'))
            ->add('DateNaiss', DateTimeType::class, array('input' => 'datetime', 'widget' => 'single_text', 'required' => false, 'label' => 'Date de naissance', 'placeholder' => 'jj/mm/aaaa'));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Responsable::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Cours;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle',TextType::class)
            ->add('agemini',IntegerType::class)
            ->add('agemaxi',IntegerType::class)
            ->add('instrument',EntityType::class,array('class'=>'App\Entity\Instrument','choice_label' => 'intitule'))
            ->add('jour',EntityType::class,array('class'=>'App\Entity\Jour','choice_label' => 'libelle','multiple' => true))
            ->add('heureDebut',TimeType::class)
            ->add('heureFin',TimeType::class)
            ->add('typeDeCours',EntityType::class,array('class'=>'App\Entity\TypeDeCours','choice_label' => 'libelle'))
            ->add('professeur',EntityType::class,array('class'=>'App\Entity\Professeur','choice_label' => 'nom'))
            ->add('nbplaces',IntegerType::class)
            
            ->add('enregistrer', SubmitType::class, array('label' => 'Sauvegarder le cours'))
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}

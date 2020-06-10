<?php

namespace App\Form;

use App\Entity\Program;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('summary')
            ->add('poster')
            /*  ->add('category')   Remplacement de la ligne originelle par celle ci-dessous.
            Symfony ne reconnait pas l'objet category par défaut et l'assimille à l'entité Category.
            Or on ne peut pas demander à afficher directement l'entité, mais plutôt le champ category d'un programme.
            Pour pallier à ce pbm, on selectionne le champ choisi à afficher, ici le 'name'.    */
            ->add('category', null, ['choice_label' => 'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}

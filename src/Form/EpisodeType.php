<?php

namespace App\Form;

use App\Entity\Episode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EpisodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('number')
            ->add('synopsis')
            //  ->add('season')     Voir pourquoi commenté dans ProgrammeType.php !
            //  ->add('program', null, ['choice_label' => 'title'])
            //  ->add('season', null, ['choice_label' => 'number'])
            ->add('season', null, ['choice_label' => 'label'])
            //  Raison de la ligne ci-dessus dans le fichier Entity/Season.php, methode getLabel()
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Episode::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse')
            ->add('ville')
            ->add('codePostal')
            ->add('dateConstruct')
            ->add('surface')
            ->add('proprietaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}

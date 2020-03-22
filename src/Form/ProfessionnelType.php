<?php

namespace App\Form;

use App\Entity\Professionnel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ProfessionnelType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('nomEntrep')
    ->add('email')
    ->add('password')
    ->add('password', RepeatedType::class, [
      'type' => PasswordType::class,
      'invalid_message' => 'Les mots de passe saisis ne correspondent pas.',
      'options' => ['attr' => ['class' => 'password-field']],
      'required' => true,
      'first_options'  => ['label' => 'Mot de passe'],
      'second_options' => ['label' => 'Répétez la saisie du mot de passe'],
    ])
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Professionnel::class,
    ]);
  }
}

<?php

namespace Blog\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


use Vich\UploaderBundle\Form\Type\VichImageType;

class RegistrationFormType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('nom')
    ->add('prenom')
    ->add('imageFile', VichImageType::class, array('label' => ' ', 'required' => false))
    ;
  }


  public function getParent()
  {
    return 'FOS\UserBundle\Form\Type\RegistrationFormType';
  }

  // BC for SF < 3.0
  public function getName()
  {
    return $this->getBlockPrefix();
  }

  public function getBlockPrefix()
  {
    return 'app_user_registration';
  }
}

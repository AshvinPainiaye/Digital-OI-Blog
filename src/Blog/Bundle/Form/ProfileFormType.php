<?php

namespace Blog\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\File\File;

class ProfileFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
        // ->add('nom', UserType::class)
        ->add('nom', null, array('label' => 'form.nom'))
        ->add('prenom')
        ->add('imageFile', VichImageType::class, array('label' => ' ', 'required' => false))
        ;
    }

    public function getParent()
    {
      return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }


    // BC for SF < 3.0
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    // /**
    //  * Builds the embedded form representing the user.
    //  *
    //  * @param FormBuilderInterface $builder
    //  * @param array                $options
    //  */
    // protected function buildUserForm(FormBuilderInterface $builder, array $options)
    // {
    //     $builder
    //         ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
    //         ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
    //     ;
    // }
}

<?php

namespace UserBundle\Form;

use FormBundle\Model\AbstractForm;
use FormBundle\Model\FormBuilder;
use UserBundle\Entity\User;

class UserConnexionForm extends AbstractForm
{
    public function buildForm(FormBuilder $builder)
    {
        $builder
            ->setEntityName($this->getName())
            ->add('email', 'email', array(
                'label' => array(
                    'text'  => 'Email',
                    'class' => 'sr-only'
                ),
                'attr' => array(
                    'class'         => 'form-control',
                    'id'            => 'email',
                    'placeholder'   => 'Email'
                )
            ))
            ->add('password', 'password', array(
                'label' => array(
                    'text'  => 'Mot de passe',
                    'class' => 'sr-only'
                ),
                'attr' => array(
                    'class'         => 'form-control',
                    'id'            => 'password',
                    'placeholder'   => 'Password'
                )
            ))

        ;
        $this->setForm($builder->getForm());
    }

    public function configureOptions(AbstractForm $abstractForm)
    {
        $abstractForm->setEntity(User::class);
    }

    private function getName()
    {
        return 'user';
    }
}
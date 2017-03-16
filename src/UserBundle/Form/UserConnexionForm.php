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
                'attr' => array(
                    'class'         => 'form-control',
                    'id'            => 'email',
                    'placeholder'   => 'Email'
                )
            ))
            ->add('password', 'password', array(
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
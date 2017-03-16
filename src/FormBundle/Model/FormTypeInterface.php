<?php

namespace FormBundle\Model;


interface FormTypeInterface
{
    public function buildForm(FormBuilder $builder);

    public function configureOptions(AbstractForm $abstractForm);

    public function getName();
}
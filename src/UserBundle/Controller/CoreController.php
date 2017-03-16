<?php

namespace UserBundle\Controller;


use ControllerBundle\Model\Controller;
use UserBundle\Entity\User;
use UserBundle\Model\Users;

class CoreController extends Controller
{
    public function connexionAction()
    {
        $user = new User(array(
            'email'     => $_POST['_email'],
            'password'  => $_POST['_password']
        ));
        $users = new Users();
        $errors = $users->validateConnexion($user);
        if (count($errors) == 0) {
            var_dump('empty');
        } else {
            $this->setFormSession($errors);
            var_dump($this->getFormSession());
            var_dump('not empty');
        }
    }
}
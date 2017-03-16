<?php

namespace UserBundle\Model;


use UserBundle\Entity\User;

class UserValidator
{

    public function validate(User $user)
    {
        $errors = [];
        if (!$this->validateEmail($user->getEmail(), $msg)) {
            $errors['_email'] = [$msg];
        }
        if (!$this->validatePassword($user->getPassword(), $msg)) {
            $errors['_password'] = [$msg];
        }
        return $errors;
    }

    private function validateEmail($email, &$msg)
    {
        if (empty($email)) {
            $msg = "L'email est obligatoire.";
            return false;
        }
        return true;
    }

    private function validatePassword($password, &$msg)
    {
        if (empty($password)) {
            $msg = 'Le mot de passe est obligatoire.';
            return false;
        }
        return true;
    }
}
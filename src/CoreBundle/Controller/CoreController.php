<?php

namespace CoreBundle\Controller;

use ControllerBundle\Model\Controller;
use FormBundle\Model\FormBuilder;
use UserBundle\Entity\User;
use UserBundle\Form\UserConnexionForm;
use UserBundle\Model\Users;

class CoreController extends Controller
{
    public function accueilAction()
    {
        $users = new Users();
        if ($users->getIfUserIsConnect()) {
            $this->render('CoreBundle::Home:membre_accueil.html.twig');
        } else {
            $userForm = new UserConnexionForm(new User());
            $userForm->buildForm(new FormBuilder());
            $this->render('CoreBundle::Home:public_accueil.html.twig', array(
                'form_connexion' => $userForm->createView()
            ));
        }
    }
}
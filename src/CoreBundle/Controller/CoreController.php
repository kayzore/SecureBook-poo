<?php

namespace CoreBundle\Controller;

use ControllerBundle\Model\Controller;
use UserBundle\Form\Type\UserConnexionType;
use UserBundle\Model\Users;

class CoreController extends Controller
{
    public function accueilAction()
    {
        $users = new Users();
        if ($users->getIfUserIsConnect()) {
            $this->render('CoreBundle::Home:membre_accueil.html.twig');
        } else {
            $userForm = $this->buildForm(new UserConnexionType());
            $this->render('CoreBundle::Home:public_accueil.html.twig', array(
                'form_connexion' => $userForm->createView()
            ));
        }
    }
}
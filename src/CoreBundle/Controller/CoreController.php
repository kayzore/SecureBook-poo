<?php

namespace CoreBundle\Controller;

use ControllerBundle\Model\Controller;
use UserBundle\Model\Users;

class CoreController extends Controller
{
    public function accueilAction()
    {
        $users = new Users();
        var_dump($users->getUser());
        $this->render('CoreBundle::Home:accueil.html.twig');
    }
}
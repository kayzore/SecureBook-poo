<?php

namespace CoreBundle\Controller;

use ControllerBundle\Model\Controller;

class CoreController extends Controller
{
    public function accueilAction()
    {
        $this->render('CoreBundle::Home:accueil.html.twig');
    }
}
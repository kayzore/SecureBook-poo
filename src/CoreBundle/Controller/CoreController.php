<?php

namespace CoreBundle\Controller;

use src\ControllerBundle\Model\Controller;

class CoreController extends Controller
{
    public function accueilAction()
    {
        $this->render('CoreBundle:index.html.twig');
    }
}
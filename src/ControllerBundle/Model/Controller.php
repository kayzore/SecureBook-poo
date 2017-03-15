<?php

namespace ControllerBundle\Model;


use Twig_Environment;
use Twig_Loader_Filesystem;

abstract class Controller
{
    /**
     * Render view
     * @param $path
     * @param array $vars
     */
    protected function render($path, array $vars = array())
    {
        $array = explode('::', $path);
        $bundle = $array[0];
        $folder_and_view = str_replace(':', '/', $array[1]);
        $loader = new Twig_Loader_Filesystem('../src/' . $bundle . '/Ressources/Views/');
        $twig = new Twig_Environment($loader, array(
            'cache' => false,
            'debug' => true
        ));
        echo $twig->render($folder_and_view, $vars);
    }

    /**
     * Check si la requête HTTP est une requête ajax
     * @return bool
     */
    protected function isXmlHttpRequest() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) ? true : false);
    }
}
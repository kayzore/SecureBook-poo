<?php

namespace src\ControllerBundle\Model;


use Twig_Environment;
use Twig_Loader_Filesystem;

abstract class Controller
{
    private $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(RACINE_WEB . 'src/views/');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false,
            'debug' => true
        ));
    }

    /**
     * Render view
     * @param $path
     * @param array|null $vars
     */
    protected function render($path, array $vars = null)
    {
        $array = explode(':', $path);
        var_dump($array);
        //echo $this->twig->render(, $vars);
    }

    /**
     * Check si la requête HTTP est une requête ajax
     * @return bool
     */
    public function isXmlHttpRequest() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) ? true : false);
    }
}
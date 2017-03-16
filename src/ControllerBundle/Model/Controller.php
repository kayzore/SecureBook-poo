<?php

namespace ControllerBundle\Model;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Chain;
use Twig_Loader_Filesystem;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

abstract class Controller
{
    /**
     * @var Twig_Environment
     */
    private $twig;
    /**
     * @var array
     */
    private static $parameter = array();

    public function __construct()
    {
        session_start();
        try {
            $this->setParameter(Yaml::parse(file_get_contents('../app/Config/parameters.yml')));
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
    }

    /**
     * Init Twig and call Render view function
     * @param $path
     * @param array $vars
     */
    protected function render($path, array $vars = array())
    {
        $array = explode('::', $path);
        $bundle = $array[0];
        $path = str_replace(':', '/', $array[1]);
        $loader1 = new Twig_Loader_Filesystem('../app/Ressources/Views/');
        $loader2 = new Twig_Loader_Filesystem('../src/' . $bundle . '/Ressources/Views/');

        $loader = new Twig_Loader_Chain(array($loader1, $loader2));
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false,
            'debug' => true
        ));
        $this->initTwigExtensions();
        $this->initTwigFilters();
        $this->initTwigFunctions();
        $this->initTwigGlobals();

        $this->renderView($path, $vars);
    }

    /**
     * Render View
     * @param $path
     * @param array $vars
     */
    private function renderView($path, array $vars)
    {
        echo $this->twig->render($path, $vars);
    }

    /**
     * Init Twig extensions
     */
    private function initTwigExtensions()
    {
        $this->twig->addExtension(new Twig_Extension_Debug());
    }

    /**
     * Init custom twig filters
     */
    private function initTwigFilters()
    {
        $truncate_filter = new Twig_SimpleFilter('truncate', function ($string, $limit) {
            if (strlen($string) > $limit) {
                return substr($string, 0, $limit - 3) . '...';
            } else {
                return $string;
            }
        });
        $this->twig->addFilter($truncate_filter);
    }

    /**
     * Init custom twig functions
     */
    private function initTwigFunctions()
    {
        $get_route_function = new Twig_SimpleFunction('path', function ($route_name, array $route_options = []) {
            return '#';
        });
        $this->twig->addFunction($get_route_function);
        $get_assets = new Twig_SimpleFunction('asset', function ($path) {
            return '../' . $this->getParameter()['parameters']['project_sub_folder'] . '/web/assets/' . $path;
        });
        $this->twig->addFunction($get_assets);
        $is_connect = new Twig_SimpleFunction('isConnect', function () {
            return (!is_null($_SESSION[Controller::getParameter()['parameters']['project_alias'] . '_utilisateur']) ? true : false);
        });
        $this->twig->addFunction($is_connect);
    }

    /**
     * Init custom twig globals
     */
    private function initTwigGlobals()
    {
        //$this->twig->addGlobal('dev_mode', DEV_MODE);
        if (isset($_SESSION['ls_utilisateur'])) {
            $this->twig->addGlobal('user', $_SESSION['ls_utilisateur']);
        }
    }

    /**
     * Check si la requête HTTP est une requête ajax
     * @return bool
     */
    protected function isXmlHttpRequest() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) ? true : false);
    }

    /**
     * @return array
     */
    public static function getParameter()
    {
        return self::$parameter;
    }

    /**
     * @param array $parameter
     */
    public function setParameter(array $parameter)
    {
        self::$parameter = $parameter;
    }


}
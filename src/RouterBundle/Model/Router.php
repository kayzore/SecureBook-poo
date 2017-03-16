<?php

namespace RouterBundle\Model;

use app\Configuration;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class Router extends Configuration
{
    /**
     * @var array $routes
     */
    private $routes;

    /**
     * @var array $bundle_list = array('name' => $bundleName, 'path' => /path/to/bundle)
     */
    private $bundle_list;

    public function __construct()
    {
        session_start();
        $this->start();
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param array $routes
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param array $bundle_list List of all bundle
     */
    public function setBundleList(array $bundle_list)
    {
        $this->bundle_list = $bundle_list;
    }

    /**
     * @return array List of all bundle
     */
    public function getBundleList()
    {
        return $this->bundle_list;
    }

    /**
     * Start route system
     */
    private function start()
    {
        $this->searchAllBundle();
        $this->searchAllRoutes();
        $this->searchRoute();
    }

    /**
     * Search all bundle in project
     */
    private function searchAllBundle()
    {
        $root = __DIR__ . '/../../../src';
        $folder_list = scandir($root);
        $bundles = [];
        foreach($folder_list as $element){
            if(is_dir($root. '/' . $element) && $element !== '.' && $element !== '..' && strpos($element, 'Bundle') !== false ){
                $bundles[] = array(
                    'name' => $element,
                    'path' => $root. '/' . $element
                );
            }
        }
        $this->setBundleList($bundles);
    }

    /**
     * Search all routes in project
     */
    private function searchAllRoutes()
    {
        $routes_tmp = [];
        try {
            foreach ($this->getBundleList() as $bundle) {
                if (file_exists($bundle['path'] . '/Ressources/Config/routing.yml')){
                    $routes_tmp = Yaml::parse(file_get_contents($bundle['path'] . '/Ressources/Config/routing.yml'));
                }
            }
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
        $routes = [];
        foreach ($routes_tmp as $name => $route) {
            $default = explode(':', $route['default']['_controller']);

            $routes[] = new Route(array(
                'name' => $name,
                'path' => $route['path'],
                'methods' => $route['methods'],
                'bundle' => $default[0],
                'controller' => $default[1] . 'Controller',
                'action' => $default[2] . 'Action'
            ));
        }
        $parameters = Yaml::parse(file_get_contents('../app/Config/parameters.yml'));
        $_SESSION[$parameters['parameters']['project_alias'] . '_routes'] = $routes;
        //var_dump($_SESSION[$parameters['parameters']['project_alias'] . '_routes']);
        $this->setRoutes($routes);
    }

    /**
     * Search route, if not exist return 404 else instanciate controller
     * TODO: Create 404 not found page
     * TODO: Create Access denied
     */
    private function searchRoute()
    {
        $match_route = array(false, '');
        foreach ($this->getRoutes() as $route) {
            if ($route->getPath() === '/' . $_GET['url'] || $route->getPath() === '/' . $_GET['url'] . '/') {
                $match_route[0] = true;
                $match_route[1] = $route;
                break;
            }
        }
        if ($match_route[0]) {
            $controller = '\\' . $match_route[1]->getBundle() . '\Controller\\' . $match_route[1]->getController();
            $request_method = false;
            foreach ($match_route[1]->getMethods() as $method) {
                if ($method === $_SERVER['REQUEST_METHOD']) {
                    $request_method = true;
                    break;
                }
            }
            if ($request_method) {
                $action = $match_route[1]->getAction();
                $controller = new $controller();
                $controller->$action();
            } else {
                // ERROR Access via this request method not authorized
                echo 'ERROR Access via this request method not authorized';
            }
        } else {
            // ERROR 404 NOT FOUND
            echo 'ERROR 404 NOT FOUND';
        }
    }

    /**
     *
     * @param $route_name
     * @return bool|string
     */
    public static function getRoute($route_name)
    {
        $search_path = false;
        $parameters = Yaml::parse(file_get_contents('../app/Config/parameters.yml'));
        foreach ($_SESSION[$parameters['parameters']['project_alias'] . '_routes'] as $route) {
            if ($route->getName() === $route_name) {
                $search_path = $route->getPath();
                break;
            }
        }
        return '/' . $parameters['parameters']['project_sub_folder'] .  $search_path;
    }
}
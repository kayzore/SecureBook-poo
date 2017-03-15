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
        var_dump('/' . $_GET['url']);
        var_dump($this->getRoutes());
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
        $routes = [];
        try {
            foreach ($this->getBundleList() as $bundle) {
                if (file_exists($bundle['path'] . '/Ressources/Config/routing.yml')){
                    $routes = Yaml::parse(file_get_contents($bundle['path'] . '/Ressources/Config/routing.yml'));
                }
            }
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
        $this->setRoutes($routes);
    }


}
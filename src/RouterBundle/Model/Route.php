<?php
namespace RouterBundle\Model;


class Route
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $path;
    /**
     * @var array
     */
    private $methods;
    /**
     * @var string
     */
    private $bundle;
    /**
     * @var string
     */
    private $controller;
    /**
     * @var string
     */
    private $action;

    public function __construct(array $route)
    {
        $this->setName($route['name']);
        $this->setPath($route['path']);
        if (isset($route['methods'])) {
            $this->setMethods($route['methods']);
        } else {
            $this->setMethods(array('GET', 'POST'));
        }
        $this->setBundle($route['bundle']);
        $this->setController($route['controller']);
        $this->setAction($route['action']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     */
    public function setMethods($methods)
    {
        $this->methods = $methods;
    }

    /**
     * @return string
     */
    public function getBundle()
    {
        return $this->bundle;
    }

    /**
     * @param string $bundle
     */
    public function setBundle($bundle)
    {
        $this->bundle = $bundle;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

}
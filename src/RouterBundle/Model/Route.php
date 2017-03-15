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
    private $bundle_name;
    /**
     * @var string
     */
    private $controller_name;
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
        $this->setBundleName($route['bundle_name']);
        $this->setControllerName($route['controller_name']);
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
    public function getBundleName()
    {
        return $this->bundle_name;
    }

    /**
     * @param string $bundle_name
     */
    public function setBundleName($bundle_name)
    {
        $this->bundle_name = $bundle_name;
    }

    /**
     * @return string
     */
    public function getControllerName()
    {
        return $this->controller_name;
    }

    /**
     * @param string $controller_name
     */
    public function setControllerName($controller_name)
    {
        $this->controller_name = $controller_name;
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
<?php

namespace app;

class Configuration
{
    /**
     * @var array $registerBundle
     */
    private $registerBundle = array(
        'ActivityBundle',
        'CoreBundle',
        'RouterBundle',
        'UserBundle',
    );

    /**
     * @return array
     */
    public function getRegisterBundle()
    {
        return $this->registerBundle;
    }
}
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

    public function getRegisterBundle()
    {
        return $this->registerBundle;
    }
}
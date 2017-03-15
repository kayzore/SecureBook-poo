<?php

namespace UserBundle\Model;


use ControllerBundle\Model\Controller;
use UserBundle\Entity\User;

class Users
{
    /**
     * @var array|null
     */
    private $session = null;
    /**
     * @var User
     */
    private  $user;

    public function __construct()
    {
        if (empty($_SESSION[Controller::getParameter()['parameters']['project_alias'] . '_utilisateur'])) {
            $_SESSION[Controller::getParameter()['parameters']['project_alias'] . '_utilisateur'] = null;
            $this->setSession(null);
        } else {
            $session = $this->getSession();
            self::setUser(new User(
                $session['username'],
                $session['email'],
                $session['roles'],
                $session['friends'],
                $session['id'],
                $session['register_date']
            ));
        }
    }

    /**
     * Return true if the user is connect else return false
     * @return bool
     */
    public function getIfUserIsConnect()
    {
        return (!is_null($this->getSession()) ? true : false);
    }

    /**
     * @return array
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param array|null $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}
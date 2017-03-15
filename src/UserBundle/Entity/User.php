<?php

namespace UserBundle\Entity;


class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $username_slug;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var array
     */
    private $roles;
    /**
     * @var array
     */
    private $friends = array();
    /**
     * @var \DateTime
     */
    private $register_date;

    public function __construct($username, $email, array $roles, array $friends, $id = null, $register_date = null, $password = null)
    {
        if (!is_null($id)) {
            $this->setId($id);
        }
        $this->setUsername($username);
        $this->setEmail($email);
        if (!is_null($password)) {
            $this->setPassword($password);
        }
        $this->setRoles($roles);
        $this->setFriends($friends);
        if (!is_null($register_date)) {
            $this->setRegisterDate($register_date);
        } else {
            $this->setRegisterDate(new \DateTime());
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsernameSlug()
    {
        return $this->username_slug;
    }

    /**
     * @param string $usernameSlug
     * @return User
     */
    public function setUsernameSlug($usernameSlug)
    {
        $this->username_slug = $usernameSlug;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return array
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * @param array $friends
     * @return User
     */
    public function setFriends($friends)
    {
        $this->friends = $friends;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRegisterDate()
    {
        return $this->register_date;
    }

    /**
     * @param \DateTime $register_date
     */
    public function setRegisterDate($register_date)
    {
        $this->register_date = $register_date;
    }
}
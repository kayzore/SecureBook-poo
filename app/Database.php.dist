<?php

namespace app;

use PDO;

class Database
{
    /**
     * @var string $db_host
     */
    private static $db_host = '';
    /**
     * @var string $db_name
     */
    private static $db_name = '';
    /**
     * @var string $db_user
     */
    private static $db_user = '';
    /**
     * @var string $db_password
     */
    private static $db_password = '';
    /**
     * @var PDO $instance
     */
    private static $instance;
    /**
     * @var array $db_options
     */
    private static $db_options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    private function __construct() {}

    /**
     * @return string
     */
    public static function getDbHost()
    {
        return self::$db_host;
    }

    /**
     * @return string
     */
    public static function getDbUser()
    {
        return self::$db_user;
    }

    /**
     * @return string
     */
    public static function getDbPassword()
    {
        return self::$db_password;
    }

    /**
     * @return string
     */
    public static function getDbName()
    {
        return self::$db_name;
    }

    /**
     * @return array
     */
    public static function getDbOptions()
    {
        return self::$db_options;
    }

    /**
     * Crée une instance de PDO si elle n'existe pas déjà
     * @return PDO
     */
    public static function getPdo()
    {
        if (is_null(self::$instance)) {
            self::$instance = new  PDO(
                'mysql:dbname=' . self::getDbName() . ';' .
                'host=' . self::getDbHost(),
                self::getDbUser(),
                self::getDbPassword(),
                self::getDbOptions()
            );
        }
        return self::$instance;
    }
}
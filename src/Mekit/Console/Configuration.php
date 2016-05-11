<?php
/**
 * Created by PhpStorm.
 * User: jackisback
 * Date: 14/11/15
 * Time: 22.32
 */

namespace Mekit\Console;

use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;

class Configuration {
    /** @var  string */
    private static $configurationFilePath;

    /** @var array */
    private static $configuration;


    /**
     * @param string $name
     * @return bool|\PDO
     */
    public static function getDatabaseConnection($name) {
        $cfg = self::getConfiguration();
        if (!isset($cfg["database"][$name]) || !is_array($cfg["database"][$name])) {
            throw new \LogicException("Missing configuration for $name in 'database' section!");
        }
        $serverName = $cfg["database"][$name]["servername"];
        $database = $cfg["database"][$name]["database"];
        $username = $cfg["database"][$name]["username"];
        $password = $cfg["database"][$name]["password"];
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            \PDO::ATTR_TIMEOUT => 10,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        );
        $dsn = 'mysql:host=' . $serverName . ';dbname=' . $database;
        $connection = new \PDO($dsn, $username, $password, $options);
        return $connection;
    }



    /**
     * @param string $configurationFilePath
     */
    public static function initializeWithConfigurationFile($configurationFilePath) {
        self::$configurationFilePath = $configurationFilePath;
    }

    /**
     * @return array
     */
    public static function getConfiguration() {
        if (!self::$configuration) {
            self::loadConfiguration();
        }
        return self::$configuration;
    }

    /**
     * @throws \Exception|ParseException
     */
    protected static function loadConfiguration() {
        $configPath = realpath(self::$configurationFilePath);
        if (!file_exists($configPath)) {
            throw new \InvalidArgumentException("The configuration file does not exist!");
        }
        $fs = new Filesystem();
        $yamlParser = new Parser();
        $config = $yamlParser->parse(file_get_contents($configPath));
        if (!is_array($config) || !isset($config["configuration"])) {
            throw new \InvalidArgumentException("Malformed configuration file!" . $configPath);
        }

        $imports = [];
        if (isset($config["imports"]) && is_array($config["imports"]) && count($config["imports"])) {
            $imports = $config["imports"];
            unset($config["imports"]);
        }


        foreach ($imports as $import) {
            if (isset($import["resource"])) {
                $resourcePath = realpath(dirname($configPath) . '/' . $import["resource"]);
                if ($resourcePath) {
                    $additionalConfig = $yamlParser->parse(file_get_contents($resourcePath));
                    $config = array_replace_recursive($additionalConfig, $config);
                }
                else {
                    throw new \LogicException(
                        "Import resource is set but cannot be found(" . $import["resource"] . ")!"
                    );
                }
            }
        }

        $config = $config["configuration"];
        //print_r($config);

        //Temporary path checks & creation
        if (isset($config["global"]["temporary_path"])) {
            if (!$fs->exists($config["global"]["temporary_path"])) {
                try {
                    $fs->mkdir($config["global"]["temporary_path"]);
                } catch(IOException $e) {
                    throw new \LogicException(
                        "Unable to create 'temporary_path'(" . $config["global"]["temporary_path"] . ")!"
                    );
                }
            }
        }

        self::$configuration = $config;
    }


}
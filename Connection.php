<?php

define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DATABASE", "pdo_samples");

/**
 * Connection Class
 * For connecting to database with a new PDO instance
 * 
 * @author Kubilay Erdogan <kublaios@gmail.com>
 * @copyright (c) 2014, Kubilay Erdogan
 */
class Connection
{
    public function dbConnect()
    {
        try {
            $db = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE. ";charset=utf8", USER, PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $e) {
            die("Connection not found. Error Code (".$e->getMessage().")");
        }

        return $db;
    }
}
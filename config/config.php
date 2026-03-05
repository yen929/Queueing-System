<?php
/*
 * Connection
 * Description: Returns a PHP Database Object
 * Author: Charlene B. Dela Cruz
 * Date Created: February 2025
 */

$host = "localhost";
$user = "root";
$pass = "";
$db   = "queuing_db";

// MySQLi connection check (if you're using MySQLi)
$conn = new mysqli($host, $user, $pass, $db);

// Check the MySQLi connection
if ($conn->connect_error) {
    die("MySQLi connection failed: " . $conn->connect_error);
} 

class Connection {
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;

    public function __construct() {
        $this->dbHost = $GLOBALS['host'];
        $this->dbUser = $GLOBALS['user'];
        $this->dbPass = $GLOBALS['pass'];
        $this->dbName = $GLOBALS['db'];
    }

    public function getConnection() {
        try {
            // Establish a PDO connection
            $pdo = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUser, $this->dbPass);
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }
        catch (Exception $e) {
            // If the connection fails, display the error message
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>
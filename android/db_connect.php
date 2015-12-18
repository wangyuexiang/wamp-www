<?php
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
 
    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once __DIR__ . '/db_config.php';
 
        // Connecting to mysql database
        try{
					// $conn = new PDO("mysql::host=DB_SERVER;dbname=DB_DATABASE",DB_USER,DB_PASSWORD);
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 				}
				catch (PDOException $e)
				{
					echo "Connection faild: " . $e->getMessage();
				}

        // returing connection cursor
        return $conn;
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
				$conn = null;
    }
 
}
 
?>
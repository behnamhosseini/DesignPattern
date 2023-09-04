<!-- Description: In many applications, you want to ensure that you have a single database connection 
throughout the application's lifecycle. The Singleton pattern can be used to manage a single database connection. -->

<?php
class DatabaseConnection {
    private static $instance;
    private $connection;

    private function __construct() {
        // Initialize the database connection here
        $this->connection = new PDO('mysql:host=localhost;dbname=mydb', 'username', 'password');
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}

// Usage
$dbConnection1 = DatabaseConnection::getInstance();
$connection1 = $dbConnection1->getConnection();

$dbConnection2 = DatabaseConnection::getInstance();
$connection2 = $dbConnection2->getConnection();

// Check if both connections are the same instance
if ($connection1 === $connection2) {
    echo "Both connections are the same. This is a Singleton pattern in action.\n";
} else {
    echo "Something went wrong. Connections are not the same.\n";
}

?>
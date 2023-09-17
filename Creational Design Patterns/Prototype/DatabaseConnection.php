<!-- The Prototype design pattern is a creational pattern that focuses on creating objects by copying an existing object,
known as the prototype, rather than creating new instances from scratch. 
It allows you to create new objects that are similar to existing ones without specifying their exact class. 
This pattern is particularly useful when the cost of creating an object is more expensive or complex than copying an existing one. -->


<!-- In web applications, you often need database connections to interact with a database. Creating new database connections for 
each request can be resource-intensive. Using the Prototype pattern, you can create a prototype database connection and clone it as needed,
reducing the overhead of creating connections repeatedly. -->

<?php

// Prototype Interface
interface DatabaseConnection {
    public function connect();
    public function query($sql);
    public function close();
}

// Concrete Prototype: MySQLConnection
class MySQLConnection implements DatabaseConnection {
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect() {
        // Implement MySQL connection logic
        echo "Connected to MySQL\n";
    }

    public function query($sql) {
        // Implement MySQL query logic
        echo "Executed SQL query: $sql\n";
    }

    public function close() {
        // Implement MySQL connection closing logic
        echo "Closed MySQL connection\n";
    }

    public function clone() {
        return new MySQLConnection($this->host, $this->username, $this->password, $this->database);
    }
}

// Client Code
$mysqlPrototype = new MySQLConnection('localhost', 'username', 'password', 'mydb');

// Clone the prototype to create multiple database connections
$connection1 = $mysqlPrototype->clone();
$connection2 = $mysqlPrototype->clone();

$connection1->connect();
$connection1->query('SELECT * FROM users');
$connection1->close();

$connection2->connect();
$connection2->query('INSERT INTO orders (product_id, quantity) VALUES (1, 5)');
$connection2->close();

?>
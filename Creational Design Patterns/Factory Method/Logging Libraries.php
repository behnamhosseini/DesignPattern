<!-- Description: Logging is a crucial aspect of software development for debugging, monitoring, and error tracking. Logging libraries often use the Factory Method pattern 
to create and manage loggers for various output destinations (e.g., files, databases, console, cloud services). -->
<?php
// Abstract Product: Logger
interface Logger {
    public function log($message);
}

// Concrete Product: FileLogger
class FileLogger implements Logger {
    private $logFilePath;

    public function __construct($logFilePath) {
        $this->logFilePath = $logFilePath;
    }

    public function log($message) {
        // Implement file logging logic, append $message to $logFilePath
    }
}

// Concrete Product: DatabaseLogger
class DatabaseLogger implements Logger {
    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function log($message) {
        // Implement database logging logic, insert $message into the database
    }
}

// Abstract Creator: LoggerFactory
abstract class LoggerFactory {
    abstract public function createLogger();
}

// Concrete Creator: FileLoggerFactory
class FileLoggerFactory extends LoggerFactory {
    private $logFilePath;

    public function __construct($logFilePath) {
        $this->logFilePath = $logFilePath;
    }

    public function createLogger() {
        return new FileLogger($this->logFilePath);
    }
}

// Concrete Creator: DatabaseLoggerFactory
class DatabaseLoggerFactory extends LoggerFactory {
    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function createLogger() {
        return new DatabaseLogger($this->dbConnection);
    }
}

// Client Code
$logToConsoleFactory = new FileLoggerFactory('/var/log/app.log');
$logToDatabaseFactory = new DatabaseLoggerFactory($dbConnection);

$consoleLogger = $logToConsoleFactory->createLogger();
$databaseLogger = $logToDatabaseFactory->createLogger();

$consoleLogger->log('Error: Something went wrong in module A.');
$databaseLogger->log('User registration successful for user XYZ.');

// Use the created loggers to log messages

?>

<!-- In this example:

We have an abstract Logger interface that defines a common method log for logging messages.

Two concrete product classes (FileLogger and DatabaseLogger) implement the Logger interface, each handling logging in a specific destination (file or database).

The abstract LoggerFactory class declares a factory method createLogger, which returns a specific type of logger.

Concrete creator classes (FileLoggerFactory and DatabaseLoggerFactory) extend LoggerFactory and create instances of the corresponding logger.

In the client code, we create logger factories based on where we want to log (e.g., file or database), and then use these factories to create loggers. Finally, we use the created loggers to log messages.

This example showcases how the Factory Method pattern is beneficial in real-world software development, especially in creating and managing logging components that write to various output destinations while adhering to a common interface. -->
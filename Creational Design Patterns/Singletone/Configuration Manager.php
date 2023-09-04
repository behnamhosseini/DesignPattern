<!-- Description: Often, applications require a centralized configuration manager to store 
and provide access to configuration settings such as database credentials, API keys, or application-specific parameters. The Singleton pattern can be used to create a single, globally accessible configuration manager. -->
<?php
class ConfigurationManager {
    private static $instance;
    private $config = [];

    private function __construct() {
        // Initialize configuration settings here
        $this->config['db_host'] = 'localhost';
        $this->config['db_username'] = 'root';
        $this->config['db_password'] = 'password';
        $this->config['api_key'] = 'your_api_key';
        // Add more configuration settings as needed
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConfig($key) {
        if (isset($this->config[$key])) {
            return $this->config[$key];
        }
        return null;
    }
}

// Usage
$configManager = ConfigurationManager::getInstance();
$dbHost = $configManager->getConfig('db_host');
$dbUsername = $configManager->getConfig('db_username');
$apiKey = $configManager->getConfig('api_key');

echo "Database Host: $dbHost\n";
echo "Database Username: $dbUsername\n";
echo "API Key: $apiKey\n";

?>
<?php
class Database {
    private $host;
    private $db_name = "roquebet";
    private $username;
    private $password;
    public $conn;

    public function getConnection() {
        $this->conn = null;

        // Check if running on Azure
        if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'azurewebsites.net') !== false) {
            // Azure Database for MySQL (Flexible Server) credentials from your screenshot
            $this->host = "roquebet-server.mysql.database.azure.com"; 
            $this->username = "roquebet_admin"; 
            $this->password = "123Luis123"; // Use the password you set in Azure
        } else {
            // Local credentials
            $this->host = "localhost";
            $this->username = "root";
            $this->password = "{Pingorocho123}";
        }

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            // Log error to Azure's Log Stream
            error_log("Connection Error: " . $exception->getMessage());
            return null;
        }
        return $this->conn;
    }
}
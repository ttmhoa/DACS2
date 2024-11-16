<?php
class DB {
    const DB_SERVER = '127.0.0.1:4306';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'dadacs_ogani'; // Ensure the database name is correct

    public $con;

    function __construct() {
        // Attempt to connect to the database
        $this->con = mysqli_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME);

        // Check connection
        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error() . " (Error: " . mysqli_connect_errno() . ")");
        }

        // Set character set to utf8mb4
        mysqli_set_charset($this->con, "utf8mb4");
    }

    // Optional: Add a method to close the connection
    function close() {
        if ($this->con) {
            mysqli_close($this->con);
        }
    }

    // Optional: Add a method to get the connection
    function getConnection() {
        return $this->con;
    }
}
?>
<?php
class DB {
    public $con;
    public $local = 'localhost';
    public $resource = 'root';
    public $pass = ''; // Make sure this is correct
    public $namePJ = 'duanphp'; // Ensure this database exists

    function __construct() {
        // Attempt to connect to the database
        $this->con = mysqli_connect($this->local, $this->resource, $this->pass, $this->namePJ);

        // Check connection
        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Set character set to utf8
        mysqli_set_charset($this->con, "utf8");
    }

    function __destruct() {
        // Close the connection when the object is destroyed
        mysqli_close($this->con);
    }
}


?>
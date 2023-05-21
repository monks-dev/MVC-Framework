<?php

/**
 * PDO Database Class
 * Connect to Database
 * Create Prepared statements
 * Bind Values
 * Return Rows and Results
 */

Class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;

    private $dbhandler;
    private $statment;
    private $error;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
          PDO::ATTR_PERSISTENT => true,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        // Create PDO Instance
        try {
            $this->dbhandler = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare Statement with query
    public function query($query) {
        $this->statment = $this->dbhandler->prepare($query);
    }

    // Bind values
    public function bind($parameter, $value, $type = null) {
        if(is_null($type)){
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }

        $this->statment->bindValue($parameter, $value, $type);
    }

    // Execute the prepared Statement
    public function execute() {
        return $this->statment->execute();
    }

    // Get result set as array of objects
    public function resultSet() {
        $this->execute();
        return $this->statment->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as Object
    public function single() {
        $this->execute();
        return $this->statment->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount() {
        return $this->statment->rowCount();
    }

}
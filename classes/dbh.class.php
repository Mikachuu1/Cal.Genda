<?php
// This file creates mySQL connection using PDO (PHP Data Objects)
// https://www.youtube.com/watch?v=yWJFbPT3TC0
class Dbh{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    public function connect(){
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "mydb";
        $this->charset = "utf8mb4";

        // In case we get an error during the connection we set try & catch exception
        try{
            // dsn - data source name, it is  1st param in creating new PDO object, 
            // 4 params for creating dsn:db driver, host, database name and character set
            // if use phpMyAdmin inside localhost then db driver is mysql
            // Note that $dsn, which is created below is a string, i.e. we use dots "." to concatenate pieces
            $dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
            //$conn variable is actual pdo connection, Dan uses $pdo name for that
            // you need 3 params to create $conn: $dsn, username, and password
            $conn = new PDO($dsn,$this->username,$this->password);
            // set Attributes inside PDO connection in order to get a proper error message inside catch fn
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // run setAttribute method, so when we get an error we can show it inside website
            // lastly we need to return that $conn variable
            return $conn;

        } catch (PDOException $e){
            echo "Connection failed: ".$e->getMessage();

        }


        
    }
}
?>
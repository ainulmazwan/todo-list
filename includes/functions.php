<?php
    //connect to database
    function connectToDB(){
        $host = "127.0.0.1";
        $database_name = "todolist"; // connect to which database
        $database_user = "root";
        $database_password = "";
        
        // 2. connect PHP with MySQL database
        // PDO (PHP database object)
        $database = new PDO(
            "mysql:host=$host;dbname=$database_name",
            $database_user, //username
            $database_password //password
        );
        return $database;
    }
?>
<?php 
    $host = "127.0.0.1";
    $database_name = "todolist"; // connect to which database
    $database_user = "root";
    $database_password = "";

    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user, //username
        $database_password //password
    );

    $completed = $_POST["completed"];
    $id  = $_POST["id"];


    if ($completed==0){
        $sql = "UPDATE tasks SET completed = 1 WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
            "id" => $id
        ]);
    }else{
        $sql = "UPDATE tasks SET completed = 0 WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
            "id" => $id
        ]);
    }

    header("Location: index.php");
    exit;
?>
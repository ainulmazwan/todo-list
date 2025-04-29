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

    $sql = "SELECT * FROM tasks";
    $query = $database->prepare($sql);
    $query->execute();
    $students = $query->fetchAll();

    $id = $_POST["id"];

    var_dump($id);

    $sql = "DELETE FROM tasks WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "id" => $id
    ]);
    header("Location: index.php");
    exit;
?>
<?php 
    $database = connectToDB();

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
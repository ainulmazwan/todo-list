<?php 
    $database = connectToDB();

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
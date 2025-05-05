<?php
    $database = connectToDB();

    $sql = "SELECT * FROM tasks";
    $query = $database->prepare($sql);
    $query->execute();
    $students = $query->fetchAll();

    $name = $_POST["name"];
    
    // check if empty or not
    if (empty($name)){
        echo "Please fill up the task name";
    }else{
        // 3. add the student name to students table
        // 3.1 SQL command (recipe)
        $sql = "INSERT INTO tasks (`task`) VALUES (:name)";
        // 3.2 prepare your SQL query (prepare materials)
        $query = $database->prepare( $sql );
        // 3.3 execute the SQL query (cook it)
        $query->execute([
            "name" => $name
        ]);
    
        // 4. redirect user back to index.php
        header("Location: index.php");
        exit;
    }


?>
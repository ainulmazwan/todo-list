<?php

    $database = connectToDB();

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ( empty( $name) || empty( $email) || empty($password) || empty($confirm_password)){
        echo "All the fields are required";
    }else if ($password!== $confirm_password) {
        echo "Your password does not match";
    }else{
        // 5. create a user account
        // 5.1 SQL command
        $sql = "SELECT * FROM users WHERE email = :email";
        // 5.2 prepare
        $query = $database->prepare($sql);

        // 5.3 execute
        $query -> execute([
            "email" => $email
            
        ]);

        $user = $query->fetch();
        // check if user exist
        if($user){
            echo "email provided exists";
        }else{
            // 6. create a user account
            // 6.1 SQL command
            $sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)";
            // 6.2 prepare
            $query = $database->prepare( $sql );
            // 6.3 execute
            $query->execute([
                "name" => $name,
                "email" => $email,
                "password" => password_hash( $password, PASSWORD_DEFAULT )
            ]);

            // 6. redirect to login.php
            header("Location: /login");
            exit;
        }

    } 
?>
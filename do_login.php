<?php
    // start session (we want to use $_SESSION in the page)
    session_start();

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

    $email = $_POST["email"];
    $password = $_POST["password"];

    // 4. check for error
    if (empty($email) || empty($password)){
        echo "All fields are required";
    }else{
        // 5. get the user data by email
        // 5.1 SQL
        $sql = "SELECT * FROM users WHERE email = :email";
        // 5.2 prepare
        $query = $database->prepare($sql);
        // 5.3 execute
        $query->execute([
            "email"=> $email
        ]);
        //5.4 fetch
        $user = $query->fetch(); // returns the first row of the list

        // check if the user exists
        if ($user){
            // 6. check if the password is correct or not
            if (password_verify($password, $user["password"])){
                // 7. store the user data in the session storage to login the user
                $_SESSION["user"] = $user;

                // 8. redirect back to index.php
                header("Location: index.php");
            }else{
                echo "The password provided is incorrect";
            }
        }else{
            echo "The email provided does not exist";
        };
    };

?>
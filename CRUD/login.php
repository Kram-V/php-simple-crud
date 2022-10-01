<?php

session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["username"] == "mark" && $_POST["password"] == "12345") {
        $_SESSION["is_logged_in"] = true;

        header("Location: index.php");
    } else {
        $error = "error";
    }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD APP</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

    <?php require "./includes/navbar.php" ?>

  

    <h1 class="employee-header">Login</h1>
    
    <form method="POST" class="employee-form">
        <label for="username">Username:</label><br>  
        <input type="text" id="username" name="username" placeholder="Username" /><br><br>  

        <label for="password">Password:</label><br>  
        <input type="password" id="password" name="password" placeholder="Password" /><br><br>

        <div class="btn-container">
            <button type="submit">Login</button>
        </div>
    </form>

    <div class="credentials-invalid">
        <p>
            <?= $error == "error" ? "Credentials are invalid" : "" ?>
        </p>
    </div>
    
</body>
</html>
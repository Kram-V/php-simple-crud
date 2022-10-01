<?php

require "./includes/db.php";

session_start();

if ((!isset($_SESSION["is_logged_in"]) && !$_SESSION["is_logged_in"] == true)) {
    header("Location: login.php");
}

if (isset($_POST["is_active"])) {
    $active_value = $_POST["is_active"];
} else {
    $active_value = "0";
}

$err_fullname = "";
$err_contactnum = ""; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!$_POST["fullname"] && !preg_match("/^[0-9]*$/", $_POST["contactnum"])) {
        $err_fullname = "Fullname is required";
        $err_contactnum = "Enter only numbers";
    } elseif (!$_POST["fullname"]) {
        $err_fullname = "Fullname is required";
    } elseif (!preg_match("/^[0-9]*$/", $_POST["contactnum"])) {
        $err_contactnum = "Enter only numbers";
    }  else {
        $sql = "INSERT INTO employeefile (fullname, address, birthdate, 
        age, gender, civilstat, contactnum, salary, is_active)
        VALUES ('" . $_POST['fullname'] .  "','"
                   . $_POST["address"] . "','"
                   . $_POST["birthdate"] . "','"
                   . $_POST["age"] . "','"
                   . $_POST["gender"] . "','"
                   . $_POST["civilstat"] . "','"
                   . $_POST["contactnum"] . "','"
                   . $_POST["salary"] . "','"
                   . $active_value . "')";


        $result = mysqli_query($conn, $sql);

        if ($result === false) {
            echo mysqli_error($conn);
        } else {
            header("Location: index.php");
        }
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

        <h1 class="employee-header">Add Employee</h1>

        <form method="POST" class="employee-form">
            <label for="fullname">Fullname:</label><br>  
            <input type="text" id="fullname" name="fullname" placeholder="Fullname" /><br>  
            <span class="text-required"><?= $err_fullname ? $err_fullname : "" ?></span><br>

            <label for="address">Address:</label><br>  
            <input type="text" id="address" name="address" placeholder="Address" /><br><br>

            
            <label for="birthdate">Birthdate:</label><br>  
            <input type="date"  style="width: 169px" id="birthdate" name="birthdate" /><br><br>

            <label for="age">Age:</label><br> 
            <input type="number" id="age" name="age" placeholder="Age" /><br><br>

            <p>Gender:</p>
            <input type="radio" id="male" name="gender" value="male" checked>
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>
            <input type="radio" id="other" name="gender" value="other">
            <label for="other">Other</label><br><br>

            <label for="civilstat">Civil Status:</label>
            <select name="civilstat" id="civilstat">
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="separated">Separated</option>
                <option value="widowed">Widowed</option>
            </select><br><br>

        
            <label for="contactnum">Contact Number:</label><br>
            <input type="text" id="contactnum" name="contactnum" placeholder="Contact Number">
            <span class="text-required"><?= $err_contactnum ? $err_contactnum : "" ?></span><br><br>

            <label for="salary">Salary:</label><br>
            <input type="number" id="salary" name="salary" placeholder="Salary"><br><br>
            
            <input type="checkbox" id="is_active" name="is_active" value="1">
            <label for="is_active">Is Active?</label><br><br>

            <div class="btn-container">
                <button type="submit">Submit</button>
                <a href="index.php" class="back-link">[ Back ]</a>
            </div>

        </form>


    </body>
</html>
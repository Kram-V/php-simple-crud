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

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $sql = "SELECT * FROM employeefile WHERE recid = " . $_GET["id"];

    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        echo mysqli_error($conn);
    } else {
        $employee = mysqli_fetch_assoc($result);
    }
} else {
    $employee = null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!$_POST["fullname"] && !preg_match("/^[0-9]*$/", $_POST["contactnum"])) {
        $err_fullname = "Fullname is required";
        $err_contactnum = "Enter only numbers";
    } elseif (!$_POST["fullname"]) {
        $err_fullname = "Fullname is required";
    } elseif (!preg_match("/^[0-9]*$/", $_POST["contactnum"])) {
        $err_contactnum = "Enter only numbers";
    } else {
        $sql = "UPDATE employeefile   SET fullname='" . $_POST["fullname"] . "',
                address='" . $_POST["address"] . "', birthdate='" . $_POST["birthdate"] . "',
                age= '" . $_POST["age"] . "', gender= '" . $_POST["gender"] . "',
                civilstat= '" . $_POST["civilstat"] . "', contactnum= '" . $_POST["contactnum"] . "',
                salary= '" . $_POST["salary"] . "', is_active= '" . $_POST["is_active"] . "'
                WHERE recid='" . $_GET["id"] . "'";


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

        <h1 class="employee-header">Edit Employee</h1>

        <form method="POST" class="employee-form">
            <?php if($employee): ?>

            <label for="fullname">Fullname:</label><br>  
            <input type="text" id="fullname" name="fullname" placeholder="Fullname" value="<?= !$err_fullname ? $employee["fullname"] : "" ?>" /><br>  
            <span class="text-required"><?= $err_fullname ? $err_fullname : "" ?></span><br>

            <label for="address">Address:</label><br>  
            <input type="text" id="address" name="address" placeholder="Address" value="<?= $employee["address"] ?>" /><br><br>

            
            <label for="birthdate">Birthdate:</label><br>  
            <input type="date"  style="width: 169px" id="birthdate" name="birthdate" value="<?= $employee["birthdate"] ?>" /><br><br>

            <label for="age">Age:</label><br> 
            <input type="number" id="age" name="age" placeholder="Age" value="<?= $employee["age"] ?>" /><br><br>

            <p>Gender:</p>
            <input type="radio" id="male" name="gender" value="male" <?= $employee["gender"] == "male" ? "checked" : "" ?> />
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="female" <?= $employee["gender"] == "female" ? "checked" : "" ?> />
            <label for="female">Female</label><br>
            <input type="radio" id="other" name="gender" value="other" <?= $employee["gender"] == "other" ? "checked" : "" ?> />
            <label for="other">Other</label><br><br>

            <label for="civilstat">Civil Status:</label>
            <select name="civilstat" id="civilstat">
                <option value="single" <?= $employee["civilstat"] == "single" ? "selected" : "" ?>>Single</option>
                <option value="married" <?= $employee["civilstat"] == "married" ? "selected" : "" ?>>Married</option>
                <option value="separated" <?= $employee["civilstat"] == "separated" ? "selected" : "" ?>>Separated</option>
                <option value="widowed" <?= $employee["civilstat"] == "widowed" ? "selected" : "" ?>>Widowed</option>
            </select><br><br>

        
            <label for="contactnum">Contact Number:</label><br>
            <input type="text" id="contactnum" name="contactnum" placeholder="Contact Number" value="<?=  $employee["contactnum"] ?>" />
            <span class="text-required"><?= $err_contactnum ? $err_contactnum : "" ?></span><br><br>

            <label for="salary">Salary:</label><br>
            <input type="text" id="salary" name="salary" placeholder="Salary" value="<?= $employee["salary"] ?>"><br><br>
            
            <input type="checkbox" id="is_active" name="is_active" value="1" <?= $employee["is_active"] == "1" ? "checked" : "" ?> />
            <label for="is_active">Is Active?</label><br><br>

            <div class="btn-container">
                <button type="submit">Submit</button>
                <a href="index.php" class="back-link">[ Back ]</a>
            </div>


            <?php else : ?>

                <?php  header("Location: index.php"); ?>

            <?php endif; ?>
        

        </form>


    </body>
</html>



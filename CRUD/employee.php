<?php

require "./includes/db.php";

session_start();

if ((!isset($_SESSION["is_logged_in"]) && !$_SESSION["is_logged_in"] == true)) {
    header("Location: login.php");
}

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

        <h1 class="employee-header">Employee Details</h1>

        <div class="employee-container">
            <table class="table">
                <tr>
                    <th>recid</th>
                    <th>fullname</th>
                    <th>address</th>
                    <th>birthdate</th>
                    <th>age</th>
                    <th>gender</th>
                    <th>civilstat</th>
                    <th>contactnum</th>
                    <th>salary</th>
                    <th>isactive</th>
                </tr>
                
                <?php if ($employee): ?>

                    <?php
                         $result = explode("-", $employee["birthdate"]);
                        
                         $day = $result[2];
                         $month = $result[1];
                         $year = $result[0];

                         $new_date = "$day-$month-$year";
                    ?>

                <tr>
                    <td><?= $employee["recid"] ?></td>
                    <td><?= $employee["fullname"] ?></td>
                    <td><?= $employee["address"] == "" ? "N/A" : $employee["address"] ?></td>
                    <td><?= $new_date == "00-00-0000" ? "N/A" : $new_date ?></td>
                    <td><?= $employee["age"] == "0" ? "N/A" : $employee["age"] ?></td>
                    <td><?= $employee["gender"] ?></td>
                    <td><?= $employee["civilstat"] ?></td>
                    <td><?= $employee["contactnum"] == "" ? "N/A" : $employee["contactnum"] ?></td>
                    <td><?= $employee["salary"] ?></td>
                    <td class="<?= $employee["is_active"] == "0" ? "is-active-no" : "is-active-yes" ?>"><?= $employee["is_active"] == "0" ? "No" : "Yes" ?></td>
                </tr>
            </table>
        </div>

        <?php else: ?>
                
        </table>

            <p>No Data Shows</p>

        <?php endif; ?>

    </body>
</html>
    

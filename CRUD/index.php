<?php

require "./includes/db.php";

session_start();

$sql = "SELECT * FROM employeefile ORDER BY fullname";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $employees = mysqli_fetch_all($results, MYSQLI_ASSOC);
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

       <h1 class="employee-header">Employee List</h1>

        <div class="employee-list-container">
        <a href="new-employee.php"><button class="add-btn btn">Add Employee</button></a>

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
                    <th>actions</th>
                </tr>

                

                <?php foreach ($employees as $employee): ?>

                    <?php
                         $result = explode("-", $employee["birthdate"]);
                        
                         $day = $result[2];
                         $month = $result[1];
                         $year = $result[0];

                         $new_date = "$day-$month-$year";
                    ?>

                    <tr>
                        <td><a href="employee.php?id=<?= $employee["recid"] ?>"><?= $employee["recid"] ?></a></td>
                        <td><?= $employee["fullname"] ?></td>
                        <td><?= $employee["address"] == "" ? "N/A" : $employee["address"] ?></td>
                        <td><?= $new_date == "00-00-0000" ? "N/A" : $new_date ?></td>
                        <td><?= $employee["age"] == "0" ? "N/A" : $employee["age"] ?></td>
                        <td><?= $employee["gender"] ?></td>
                        <td><?= $employee["civilstat"] ?></td>
                        <td><?= $employee["contactnum"] == "" ? "N/A" : $employee["contactnum"] ?></td>
                        <td>
                            <a href="edit-employee.php?id=<?= $employee["recid"] ?>"><button class="edit-btn btn">Edit</button></a>

                            <?php if ((!isset($_SESSION["is_logged_in"]))): ?>
                                <a href="login.php"><button  class="delete-btn btn">Delete</button></a>
                            <?php else: ?>
                                <a href="delete-employee.php?id=<?= $employee["recid"] ?>"><button  class="delete-btn btn">Delete</button></a>
                            <?php endif ?>
                            
                        </td>
                    </tr>
                <?php endforeach ?>


            </table>

            <?php if (empty($employees)): ?>

                <p class="no-employees-text">No Employees Show</p>

            <?php endif; ?>
        </div>

    </body>
</html>
    

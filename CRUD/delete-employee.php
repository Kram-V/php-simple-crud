<?php

require "./includes/db.php";


if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $sql = "SELECT * FROM employeefile WHERE recid = " . $_GET["id"];

    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        echo mysqli_error($conn);
    } else {
        $employee = mysqli_fetch_assoc($result);
    }
} 

$sql = "DELETE FROM employeefile WHERE recid='" . $_GET["id"] . "'";


$result = mysqli_query($conn, $sql);

if ($result === false) {
    echo mysqli_error($conn);
} else {
    header("Location: index.php");
}
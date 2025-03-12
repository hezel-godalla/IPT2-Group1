<?php
session_start();
include('database.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM celebrities WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "DELETED";
    } else {
        $_SESSION['status'] = "error";
    }

    mysqli_close($conn);
    header("Location: ../index.php");
    exit();
}
?>
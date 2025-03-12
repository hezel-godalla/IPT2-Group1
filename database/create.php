<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nam = $_POST['Nam'];
    $Age = $_POST['Age'];
    $Gender = $_POST['Gender'];
    $Occupation = $_POST['Occupation'];

    
    $sql = "INSERT INTO celebrities (Nam, Age, Gender, Occupation) VALUES ('$Nam', '$Age', '$Gender', '$Occupation')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "created";
    } else {
        $_SESSION['status'] = "error: "; 
    }

    mysqli_close($conn);
    header("Location: ../index.php"); 
    exit();
}
?>
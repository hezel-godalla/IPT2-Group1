<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $Nam = $_POST['Nam'];
    $Age = $_POST['Age'];
    $Gender = $_POST['Gender'];
    $Occupation = $_POST['Occupation'];

    
    $sql = "UPDATE celebrities SET 
            Nam ='$Nam', 
            Age ='$Age', 
            Gender ='$Gender', 
            Occupation ='$Occupation' 
            WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "updated";
    } else {
        $_SESSION['status'] = "error: "; 
    }

    mysqli_close($conn);
    header("Location: ../index.php"); 
    exit();
}
?>
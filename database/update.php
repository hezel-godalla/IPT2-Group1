<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $Name = $_POST['Name'];
    $Age = $_POST['Age'];
    $Gender = $_POST['Gender'];
    $Celebrities = $_POST['Celebrities'];

    
    $sql = "UPDATE celebrities SET 
            Name ='$Name', 
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
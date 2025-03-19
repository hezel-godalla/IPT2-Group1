<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $Nam = $_POST['Nam'];
    $Age = $_POST['Age'];
    $Gender = $_POST['Gender'];
    $Occupation = $_POST['Occupation'];

    // Check if required fields are not empty
    if (empty($id) || empty($Nam) || empty($Age) || empty($Gender) || empty($Occupation)) {
        $_SESSION['status'] = "error";
        header("Location: ../index.php");
        exit();
    }

    // Prepare and execute the update statement safely
    $sql = "UPDATE celebrities SET Nam = ?, Age = ?, Gender = ?, Occupation = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $Nam, $Age, $Gender, $Occupation, $id);
        if ($stmt->execute()) {
            $_SESSION['status'] = "updated";
        } else {
            $_SESSION['status'] = "error";
        }
        $stmt->close();
    } else {
        $_SESSION['status'] = "error";
    }

    mysqli_close($conn);

    // Redirect back to the main page with the current page number
    $current_page = isset($_POST['current_page']) ? (int)$_POST['current_page'] : 1;
    header("Location: ../index.php?page=$current_page");
    exit();
}
?>
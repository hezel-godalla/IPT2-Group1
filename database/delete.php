<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Validate input: Ensure ID is not empty
    if (empty($id)) {
        $_SESSION['status'] = "error";
        header("Location: ../index.php");
        exit();
    }

    // Prepare the DELETE statement
    $sql = "DELETE FROM celebrities WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id); // ID is an integer
        if ($stmt->execute()) {
            $_SESSION['status'] = "deleted";
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
} else {
    $_SESSION['status'] = "error";
    header("Location: ../index.php");
    exit();
}
?>
<?php
// Include database connection
include('dbconnect.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get User ID from the form
    $user_id = $_POST['user_id'];

    // SQL query to delete the member record
    $sql = "DELETE FROM user WHERE MemberID = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("i", $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Member record deleted successfully.";
        header("Location: adminHome.php");
    } else {
        echo "Error deleting member record: " . $conn->error;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <title>Delete Member</title>
    <link rel="stylesheet" href="admintablecss.css">
    
</head>
<body>
<div class="page-header-background">
        <div class="page-header-path">
            <a href="login.html" id="home-page">
                Home
            </a>
            <p>/</p>
            <a href="login.html" id="login-page">
                Admin Home
            </a>
        </div>
        <div class="page-header-heading">
            <h1>ADMIN HOME</h1>
        </div>
    </div>

    <div class="container">
        <h2>Delete Member</h2>
        <form method="post">
            <label for="user_id">Enter Member ID:</label>
            <input type="text" id="user_id" name="user_id" required>
            <br><br>
            <button type="submit" name="delete">Delete</button>
            <button onclick="location.href='adminHome.php'">Back</button>
        </form>

    </div>
    <footer>
        <div class="footer">
            Copyright ©2024 BVICAM , New Delhi | All rights reserved

        </div>  
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="admintablecss.css">

    <style>
    /* CSS for buttons */
    .button-container {
        text-align: center; /* Center buttons horizontally */
        margin-top: 20px; /* Add some space between the form and buttons */
    }

    .action-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #07273b; /* Change as per your design */
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none; /* Remove underline */
        font-size: 16px; /* Adjust font size */
        margin: 10px; /* Add margin around buttons */
    }

    .action-button:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }
</style>


    
</head>
<body>
<div class="info-container">
<?php
session_start();
include('dbconnect.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Home</title>
   
    <link  rel="stylesheet" href="admintablecss.css">
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
            <h1>MEMBER DETAILS</h1>
        </div>
    </div>

    
<div class="info-container">
<?php

// Check if the user is logged in and is an admin
// if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
//     // Redirect user to login page if not logged in as admin
//     header("Location: login.php");
//     exit;
// }

$sql = "SELECT * FROM user";
$result = $conn->query($sql);
// Fetch all users along with their papers
if ($result->num_rows > 0) {
    // Table for Members
    echo '<h2>Member Details</h2>';

    echo '<br>';
    echo '<div class="button-container">';
    echo '<button class="action-button" onclick="location.href=\'addMember.php\'">Add Member</button>';
    echo '<button class="action-button" onclick="location.href=\'deleteMember.php\'">Delete Member</button>';
    echo '<button class="action-button" onclick="location.href=\'updateMember.php\'">Update Member</button>';
    echo'</div>';
    echo '<br>';
    echo '<table border="1">';
    echo '<tr><th>User ID</th><th>Username</th><th>Address</th><th>Country</th><th>State</th><th>Pincode</th><th>Mobile No.</th><th>Email</th><th>Interested Event</th><th>CSI Membership No.</th><th>IEEE/ISTE/IETE/IITE/IMP Membership No.</th><th>Organisation</th><th>Category</th><th>Password</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["MemberID"] . "</td>";
        echo "<td>" . $row["Name"] . "</td>";
        echo "<td>" . $row["Address"] . "</td>";
        echo "<td>" . $row["Country"] . "</td>";
        echo "<td>" . $row["State"] . "</td>";
        echo "<td>" . $row["Pincode"] . "</td>";
        echo "<td>" . $row["Mobile"] . "</td>";
        echo "<td>" . $row["Email"] . "</td>";
        echo "<td>" . $row["Interested Event"] . "</td>";
        echo "<td>" . $row["CSI Membership No."] . "</td>";
        echo "<td>" . $row["IEEE/ISTE/IETE/IITP/IMP Membership No."] . "</td>";
        echo "<td>" . $row["Organisation"] . "</td>";
        echo "<td>" . $row["Category"] . "</td>";
        echo "<td>" . $row["Password"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}

// Close the database connection
$conn->close();
?>


</div>
<footer>
        <div class="footer">
            Copyright ©2024 BVICAM , New Delhi | All rights reserved

        </div>  
    </footer>

</body>
</html>
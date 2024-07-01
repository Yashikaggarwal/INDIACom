<?php
session_start();
include ('dbconnect.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admintablecss.css">

    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        

        .wrapper {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px; /* Add space between sections */
        }

        .info-container {
            flex: 0 0 100%; /* Occupy full width on small screens */
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin-top: 20px; /* Add space between sidebar and filter section */
            margin-left: 320px;
        }

        .info-container form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .info-container label {
            flex: 0 0 30%;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .info-container input[type="date"],
        .info-container input[type="text"] {
            flex: 0 0 calc(65% - 10px); /* Adjust width for padding */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .info-container input[type="date"]:focus,
        .info-container input[type="text"]:focus {
            outline: none;
            border-color: dodgerblue;
        }

        .info-container input[type="submit"] {
            flex: 1 0 100%;
            margin-top: 10px;
            padding: 10px;
            background-color: #07273b;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .info-container input[type="submit"]:hover {
            background-color: #0e5987;
        }

       
    </style>
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
            <h1>PAPER DETAILS</h1>
        </div>
    </div>

    <div class="wrapper">
    <div class="sidebar">
    <ul>
        <li><a href="adminHomeMember.php">Member Details</a></li>
        <li><a href="adminHomePaper.php">Paper Details</a></li>
        <li><a href="SupervisorLogin.php">Supervisor Portal</a></li>
        <!-- Add more sidebar items as needed -->
    </ul>
</div>    

<div class="info-container">
    <form method="get">
        <label for="filter_date">Filter by Date:</label>
        <input type="date" id="filter_date" name="filter_date">

        <label for="filter_event">Filter by Event:</label>
        <input type="text" id="filter_event" name="filter_event">

        <label for="filter_track">Filter by Track:</label>
        <input type="text" id="filter_track" name="filter_track">

        <label for="Status">Status:</label>
        <input type="text" id="search" name="search">
        
        
        <input type="submit" value="Filter">
    </form>
</div>


</body>
</html>



<?php 

$filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';
    $filter_event = isset($_GET['filter_event']) ? $_GET['filter_event'] : '';
    $filter_track = isset($_GET['filter_track']) ? $_GET['filter_track'] : '';
    

    $papers_sql = "SELECT * FROM paper WHERE 1=1";

    if (!empty($filter_date)) {
        $papers_sql .= " AND paperDate = '$filter_date'";
    }

    if (!empty($filter_event)) {
        $papers_sql .= " AND Event LIKE '%$filter_event%'";
    }

    if (!empty($filter_track)) {
        $papers_sql .= " AND Track LIKE '%$filter_track%'";
    }
    if (!empty($search)) {
        $papers_sql .= " AND paperStatus LIKE '%$search%'";
    }

    

    $papers_sql .= " ORDER BY paperDate DESC";

    $papers_result = $conn->query($papers_sql);

    if ($papers_result->num_rows > 0) {
        
        echo '<table border="1">';
        echo '<tr><th>Date</th><th>Member ID</th><th>Paper ID</th><th>Event</th><th>Title</th><th>Version</th><th>Track</th><th>Status</th></tr>';
        while ($paper_row = $papers_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $paper_row["paperDate"] . "</td>";
            echo "<td>" . $paper_row["MemberID"] . "</td>";
            echo "<td>" . $paper_row["PaperID"] . "</td>";

            echo "<td>" . $paper_row["Event"] . "</td>";
            echo '<td><a href="paperDetails.php?paper_id=' . $paper_row["PaperID"] . '">' . $paper_row["Title"] . '</a></td>';
            echo "<td>" . $paper_row["paperVersion"] . "</td>";
            echo "<td>" . $paper_row["Track"] . "</td>";
            echo "<td>" . $paper_row["paperStatus"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo '<p>No papers found.</p>';
    }
    $conn->close();
    ?>
</body>
</html>



</div>

    <footer>
        <div class="footer">
            Copyright ©2024 BVICAM , New Delhi | All rights reserved

        </div>  
    </footer>
</body>
</html>
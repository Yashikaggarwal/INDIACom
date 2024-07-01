<?php
session_start();
include 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Paper View</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .info
    {
        
        margin: 0 auto;
        width:80%;
        margin-bottom: 100px;
        
    }

h2 {
        margin-top: 20px;
        text-align: center;
    }

    table {
        margin-top: 10px;
        margin-left: 10px;
        margin-right: 10px;
        align-items: center;
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 30px;
    }

    th, td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #07273b;
        color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    button {
        padding: 5px 10px;
        cursor: pointer;
    }
    </style>

</head>
<body>
    <header class="header">
        <div id="first-navbar" style="background-color: #07273b;">
            <div id="first-container">
                <ul class="menu">
                    <li id="IEEE-delhi"><a style="color:#d7d005;" href="https://ewh.ieee.org/r10/delhi/" target="blank">IEEE Delhi section</a></li>
                    <li id="IEEE" ><a style="color:#d7d005;" href="https://www.ieee.org/about/index.html" target="blank">About IEEE</a></li>
                    <li id="BVICAM"><a style="color:#d7d005;" href="http://www.bvicam.ac.in/" target="blank">About BVICAM</a></li>
                </ul>
            </div>
        </div>
        <div id="second-navbar">
            <div id="second-container">
                <ul class="nav">
                    <li>
                        <a href="News.php" target="blank">News </a>
                    </li>

                    <li class="active">
                        <a href="https://bvicam.ac.in/Delcon2024/">Home</a>
                    </li>

                    <li class="dropdown" id="paperDropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Submit Paper
                            <i class="fa-solid fa-angle-down"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" id="paperDropdownMenu">
                            <li>
                                <a href="theme.php">Call for Papers</a>
                            </li>
                            <li>
                                <a href="submit-papers.php">Submit Paper</a>
                            </li>
                            <li>
                                <a href="qualities-policies.php">Quality Policies </a>
                            </li>
                        </ul>
                    </li>

                    <li class="active">
                        <a href="paperView.php">View Paper</a>
                    </li>
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Committees
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">									
                            <li>
                                <a href="committee.php">Committees</a>
                            </li>
                            <li>
                                <a href="patrons.php">Collaboration</a>
                            </li>
                        </ul>
                    </li>	

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Speakers<i class="fa-solid fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">									
                            <li>
                                <a href="call-speakers.php">Invited Speakers</a>
                            </li>
                            <li>
                                <a href="IEEE-Excom.php">IEEE ExCom </a>
                            </li>
                        </ul>
                    </li>	
                        
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Registrations
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">									
                            <li>
                                <a href="registration.php">Registrations</a>
                            </li>
                            <li>
                                <a href="travel-stay.php">Travel and Stay </a>
                            </li>
                        </ul>
                    </li>
                       	
                    <li>
                        <a href="https://chitkara.edu.in/delcon2023" target="blank">Previous Edition </a>
                    </li>		

                    <li>
                        <a href="contact.php">Contact Us</a>
                    </li>						 
                </ul>
            </div>
        </div>
    </header>

    <div class="page-header-background">
        <div class="page-header-path">
            <a href="login.html" id="home-page">
                Home
            </a>
            <p>/</p>
            <a href="login.html" id="login-page">
                View Paper
            </a>
        </div>
        <div class="page-header-heading">
            <h1>VIEW PAPER</h1>
        </div>
    </div>
    <div class="paper-details">

    
    <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if member id is set in session
if (!isset($_SESSION['member_id'])) {
    // Redirect user to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}
$member_id = $_SESSION['member_id'];

// Query to retrieve papers uploaded by the current user
$sql_user_papers = "SELECT * FROM paper WHERE MemberID = $member_id";

// Query to retrieve papers uploaded by the co-authors of the current user
$sql_coauthor_papers = "
    SELECT p.*
    FROM paper p
    INNER JOIN author a ON p.PaperID = a.PaperID
    WHERE a.MemberID = $member_id
";

// Combine the results of both queries using UNION
$sql_combined = "($sql_user_papers) UNION ($sql_coauthor_papers)";

$result = $conn->query($sql_combined);

// Check if the query was successful
if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    // Check if any rows were returned
    
if ($result->num_rows > 0) {
    echo '<h2>Papers Uploaded</h2>';
        echo '<table border="1">';
    echo "<thead><tr><th>Paper ID</th><th>Title</th><th>Version</th><th>Track</th><th>Date</th><th>Event</th><th>View PDF</th><th>View Plagiarism</th><th>Review</th></tr></thead>";
    echo "<tbody>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        
        echo "<tr>";
        echo "<td>" . $row["PaperID"] . "</td>";
        echo "<td>" . $row["Title"] . "</td>";
        echo "<td>" . $row["paperVersion"] . "</td>";
        echo "<td>" . $row["Track"] . "</td>";
        echo "<td>" . $row["paperDate"] . "</td>";
        echo "<td>" . $row["Event"] . "</td>";
        
        // Assuming $row["PaperPDF"] contains the BLOB data
        $pdfData = $row["PaperPDF"];
        echo "<td><form action='render_pdf.php' method='post' target='_blank'>";
        echo "<input type='hidden' name='pdfData' value='" . base64_encode($pdfData) . "'>";
        echo "<button type='submit'>View PDF</button>";
        echo "</form></td>";

        $pdf2Data = $row["PlagiarismReport"];
        echo "<td><form action='render_pdf.php' method='post' target='_blank'>";
        echo "<input type='hidden' name='pdf2Data' value='" . base64_encode($pdf2Data) . "'>";
        echo "<button type='submit'>View Plagiarism</button>";
        echo "</form></td>";

        echo "<td>" . $row["paperStatus"] . "</td>";
        
        echo "</tr>";
    }
    
    // End table
    echo "</tbody></table>";
    
} else {
    echo "<p>No papers submitted.</p>";
}
}

// Close connection
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
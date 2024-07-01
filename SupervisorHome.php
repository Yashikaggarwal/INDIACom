<?php
session_start();
include ('dbconnect.php');
?>
<?php
// Assuming you have a database connection established already

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which button was clicked
    if (isset($_POST["acc_dr"])) {
        // Handle "ACC_DR" button click
        $paperID = $_POST["paper_id"];
        updateStatus($paperID, 'ACC_DR');
    } elseif (isset($_POST["acc_wie"])) {
        // Handle "ACC_WIE" button click
        $paperID = $_POST["paper_id"];
        updateStatus($paperID, 'ACC_WIE');
    } elseif (isset($_POST["submit"])) {
        // Handle comment submission
        $paperID = $_POST["paper_id"];
        $comment = $_POST["comment"];
        addComment($paperID, $comment);
    }
}

function updateStatus($paperID, $newStatus)
{
    global $conn;
    // Update the paper status in the database
    $update_sql = "UPDATE paper SET paperStatus = ?, ReviewRemarks = 'Accepted Finally' WHERE PaperID = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $newStatus, $paperID);

    if ($stmt->execute()) {
        echo "Status updated successfully.";
        // Optionally, redirect to another page or refresh the current page
        header("Location: supervisorFinal.php");
        // exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
}

function addComment($paperID, $comment)
{
    global $conn;
    // Update the paper status in the database
    $update_sql = "UPDATE paper SET paperStatus ='Revision', ReviewRemarks = ? WHERE PaperID = ?";
    $stmt = $conn->prepare($update_sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return;
    }
    $stmt->bind_param("si", $comment, $paperID);

    if ($stmt->execute()) {
        echo "Comment added successfully.";
        // Optionally, redirect to another page or refresh the current page
        // header("Location: somepage.php");
        // exit();
    } else {
        echo "Error adding comment: " . $stmt->error;
    }

    $stmt->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admintablecss.css">
    

    <style>
        .menu-container {
    display: flex;
    justify-content: space-between;
}

.menu-link {
    padding: 10px;
    text-decoration: none;
    color: #07273b;
    transition: color 0.3s;
}

.menu-link:hover {
    color: #007bff;
}

.left {
    margin-right: auto; /* Pushes the left link to the left end */
}

.right {
    margin-left: auto; /* Pushes the right link to the right end */
}

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
            margin-left: 480px;
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

            <a href="login.html" id="login-page">
                Supervisor Home
            </a>
        </div>
        <div class="page-header-heading">
            <h1>Pending for Supervisory Decision</h1>
        </div>
    </div>

    <div class="menu-container">
    <a href="SupervisorHome.php" class="menu-link left">Pending for Supervisory Decision</a>
    <a href="supervisorFinal.php" class="menu-link right">Accepted after Supervisory Decision</a>
    </div>

    
    <form method="get" class="info-container">
        <label for="filter_date">Filter by Date:</label>
        <input type="date" id="filter_date" name="filter_date"><br>

        <label for="filter_event">Filter by Event:</label>
        <input type="text" id="filter_event" name="filter_event">

        <label for="filter_track">Filter by Track:</label>
        <input type="text" id="filter_track" name="filter_track">

        <label for="Status">Status:</label>
        <input type="text" id="search" name="search">

        <input type="submit" value="Filter">
    </form>
   

    <?php


    // Check if supervisor is not logged in, redirect to login page
    if (!isset($_SESSION['supervisorLoggedIn'])) {
        header("Location: SupervisorLogin.php");
        exit;
    }

    $filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';
    $filter_event = isset($_GET['filter_event']) ? $_GET['filter_event'] : '';
    $filter_track = isset($_GET['filter_track']) ? $_GET['filter_track'] : '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';
   

    // Database connection code here
    

    



    $papers_sql = "SELECT * FROM paper WHERE paperStatus = 'Accepted after Detailed Review' OR paperStatus = 'Accepted without IEEE Xplore'";


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
        // echo '<h2>Paper Details</h2>';
        echo '<table border="1">';
        echo '<tr><th>Date</th><th>Member ID</th><th>Paper ID</th><th>Event</th><th>Title</th><th>Version</th><th>Track</th><th>Status</th><th>Action</th></tr>';

        while ($paper_row = $papers_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $paper_row["paperDate"] . "</td>";
            echo "<td>" . $paper_row["MemberID"] . "</td>";
            echo "<td>" . $paper_row["PaperID"] . "</td>";
            echo "<td>" . $paper_row["Event"] . "</td>";
            echo '<td>';
            if (!empty($paper_row["PaperPDF"])) {
                $pdfData = $paper_row["PaperPDF"];
                echo '<form action="render_pdf.php" method="post" target="_blank">';
                echo '<input type="hidden" name="pdfData" value="' . base64_encode($pdfData) . '">';
                echo '<button type="submit">' . $paper_row["Title"] . '</button>';
                echo '</form>';
            } else {
                echo "PDF not available";
            }
            
            echo '</td>';
            echo "<td>" . $paper_row["paperVersion"] . "</td>";
            echo "<td>" . $paper_row["Track"] . "</td>";
            echo "<td>" . $paper_row["paperStatus"] . "</td>";
            echo "<td>"; // Opening tag for action column

            // Button to change status to "ACC_DR"
            echo '<form method="POST">';
            echo '<input type="hidden" name="paper_id" value="' . $paper_row["PaperID"] . '">'; // Hidden input to store PaperID
            echo '<button type="submit" name="acc_dr">ACC_DR</button>';
            echo '</form>';

            // Form for ACC_WIE button
            echo '<form method="POST">';
            echo '<input type="hidden" name="paper_id" value="' . $paper_row["PaperID"] . '">'; // Hidden input to store PaperID
            echo '<button type="submit" name="acc_wie">ACC_WIE</button>';
            echo '</form>';

            // Button for Comment
            echo'<button onclick="toggleCommentField()">Comment</button>';
            echo'<form id="commentForm" style="display:none;" method="POST">';
            echo '<input type="hidden" name="paper_id" value="' . $paper_row["PaperID"] . '">';
            echo'<textarea name="comment" placeholder="Write your comment here" rows="5" cols="50"></textarea>
            <br>';
            echo '<button type="submit" name="submit">Submit</button>';
            echo'</form>';



            echo "</td>"; // Closing tag for action column
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo '<p>No papers found.</p>';
    }



    $conn->close();
    ?>

<script>
function toggleCommentField() {
    var commentForm = document.getElementById("commentForm");
    if (commentForm.style.display === "none") {
        commentForm.style.display = "block";
    } else {
        commentForm.style.display = "none";
    }
}
</script>


    </div>

</body>

</html>
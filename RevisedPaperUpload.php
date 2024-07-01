<?php
   session_start();
// // Check if member id is set
if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];

    // Include database connection
    include 'dbconnect.php';

    // Prepare SQL query to fetch paper IDs associated with the member ID
    $sql = "SELECT PaperID FROM paper WHERE MemberID = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $member_id);

    // Execute the query
    if ($stmt->execute()) {
        // Bind the result variable
        $stmt->bind_result($paper_ID);

        // Initialize an empty array to store paper IDs
        $paper_ids = array();

        // Fetch paper IDs and store them in the array
        while ($stmt->fetch()) {
            $paper_ids[] = $paper_ID;
        }

        // Close statement
        $stmt->close();

        // Debugging: Output paper IDs to check if they are retrieved successfully
        //var_dump($paper_ids); // Remove this line after debugging
    } else {
        // If execution fails, display an error message
        echo "Error executing SQL query: " . $conn->error;
    }
} else {
    // If member ID is not set, display an error message
    echo "Member ID not provided.";
}

// Check if the form has been submitted
if (isset($_POST['form_submitted'])) {
    // Retrieve form data
    $paper_ID = $_POST['paper_ID'];

    // Check if files are uploaded successfully
    if (isset($_FILES['paper_pdf']['tmp_name']) && isset($_FILES['plagiarism_report']['tmp_name'])) {
        // Define file paths
        $pdf_temp_path = $_FILES['paper_pdf']['tmp_name'];
        $plagiarism_temp_path = $_FILES['plagiarism_report']['tmp_name'];
        
        // Read file contents
        $new_pdf = file_get_contents($pdf_temp_path);
        $new_plagiarism_report = file_get_contents($plagiarism_temp_path);

        // Include database connection
        include 'partials/dbconnect.php';

        // Update query to update PDF and plagiarism report
        $sql = "UPDATE paper SET PaperPDF = ?, PlagiarismReport = ? ,paperVersion=paperVersion+1, PaperDate = NOW() WHERE PaperID = ?";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);
        
        // Bind parameters
        $stmt->bind_param("sss", $new_pdf, $new_plagiarism_report, $paper_ID);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Revised paper submitted successfully!";
            header("Location: paperView.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close statement
        $stmt->close();
        
        // Close database connection
        $conn->close();
    } else {
        echo "Error: Files not uploaded successfully.";
    }
}

// //Check if the form has been submitted
// if (isset($_POST['form_submitted'])) {
//     // Retrieve form data
//     $paper_ID = $_POST['paper_ID'];
//     // $new_pdf = $_FILES['paper_pdf'];
//     // $new_plagiarism_report = $_FILES['plagiarism_report'];

//     $new_pdf = file_get_contents($_FILES['paper_pdf']['tmp_name']);
//     $new_plagiarism_report = file_get_contents($_FILES['plagiarism_report']['tmp_name']);

//     // Validate form data
//     // You may perform additional validation here as needed

//     // Update the corresponding record in the paper table
//     include 'partials/dbconnect.php'; // Include database connection

//     // Update query to update PDF and plagiarism report
//     $sql = "UPDATE paper SET PaperPDF = '$new_pdf', PlagiarismReport = '$new_plagiarism_report' WHERE PaperID = '$paper_ID'";

//     if ($conn->query($sql) === TRUE) {
//         echo "Revised paper submitted successfully!";
//     } else {
//         echo "Error updating record: " . $conn->error;
//     }

//     // Close database connection
//     $conn->close();
// }
// ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Revised Paper Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .container {
            width: 80%;
            margin: 20px auto 20px auto;
            padding: 20px;
            /* background-color: #f2f2f2; */
            border-radius: 10px;
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        select, input[type="text"], input[type="file"], input[type="checkbox"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: grey;
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 100px;
        }

        input[type="submit"]:hover {
            background-color: #07273b;
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
                        <a href="home.php">Home</a>
                    </li>

                    <li class="dropdown" id="paperDropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="uploadPaper.php">
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
                Submit Revised Paper
            </a>
        </div>
        <div class="page-header-heading">
            <h1>SUBMIT REVISED PAPER</h1>
        </div>
    </div>


    

    <!-- // if($showAlert)
    // {
    //    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    //         <strong>Success</strong> Your paper is now submitted and you can view it.
    //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    //     </button>
    //     </div>';

    // }
    // if($showError)
    // {
    //    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    //         <strong>Error!</strong>'.$showError.'
    //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //     </div>';

    // } -->



    <div class="container">
    <h2>Submit Revised Paper</h2>
    <form method="POST" enctype="multipart/form-data">
        

        <label for="paper_ID">Paper ID:</label>
            <select name="paper_ID"> <!-- Changed from paper_ID to paper_id -->
                <?php foreach($paper_ids as $id): ?>
                <option value="<?php echo $id; ?>"><?php echo $id; ?></option>
            <?php endforeach; ?>
            </select>
        <br><br>

        <label for="paper_pdf">Upload Paper PDF:</label>
        <input type="file" id="paper_pdf" name="paper_pdf" accept=".pdf" >
        <br><br>

        <label for="plagiarism_report">Upload Plagiarism Report:</label>
        <input type="file" id="plagiarism_report" name="plagiarism_report" accept=".pdf">
        <br><br> 

        <input type="checkbox" id="not_submitted_elsewhere" name="not_submitted_elsewhere" required>
        <label for="not_submitted_elsewhere">I hereby affirm that this manuscript has not been submitted or accepted for publication anywhere except this INDIACom. Further, I know that after review, if the paper is Accepted in INDIACom, I will not be permitted to Withdraw my paper.</label>
        <br><br>

        <input type="checkbox" id="copyright_transfer" name="copyright_transfer" required>
        <label for="copyright_transfer">I hereby affirm my consent to Transfer the copyright of my Paper to INDIACom and authorize the INDIACom authorities to add my paper in the Turnitin repository of INDIACom, after its Acceptance.</label>
        <br><br>

        <input type="submit" value="Submit">
        <input type="hidden" name="form_submitted" value="1">
    </form>
    </div>

    <footer>
    <div class="footer">
        Copyright ©2024 BVICAM , New Delhi | All rights reserved

    </div>
    </footer>
    
</body>
</html>
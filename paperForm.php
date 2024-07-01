<?php
error_reporting(E_ALL);
ini_set('display_error',1);

?>

<!--  
// $showAlert=false;
// $showError=false;
// session_start();
// include ('dbconnect.php');

// // Check if the form is submitted
// if (isset($_POST['form_submitted'])) {
//     // Retrieve form data
//     $event = $_POST['event'];
//     $title = $_POST['paper_title'];
//     $track = $_POST['tracks'];
//     // Assuming you have member ID stored in session
//     if (!isset($_SESSION['member_id'])) {
//         // Redirect user to login page if not logged in
//         header("Location: login.php");
//         exit;
//     }
//     $member_id = $_SESSION['member_id'];

//     // Retrieve file contents
//     $paper_pdf = file_get_contents($_FILES['paper_pdf']['tmp_name']);
//     $plagiarism_report = file_get_contents($_FILES['plagiarism_report']['tmp_name']);

//     // Prepare SQL statement
//     $sql = "INSERT INTO paper (Event, Title, Track, PaperPDF, PlagiarismReport, MemberID) VALUES (?, ?, ?, ?, ?, ?)";

//     // Prepare and bind parameters
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("sssssi", $event, $title, $track, $paper_pdf, $plagiarism_report, $member_id);

//     // Execute the statement
//     if ($stmt->execute()) {

//         $showAlert = true;
//         header("Location: paperView.php");
//         // Redirect or perform any other action after successful insertion
//     } else {
//         $showError = "Error: " . $stmt->error; // Capture error message
//     }

//     // Close statement
//     $stmt->close();
// }
//  -->

<?php
$showAlert = false;
$showError = false;
session_start();
include ('dbconnect.php');

// Check if the form is submitted
if (isset($_POST['form_submitted'])) {
    // Retrieve form data
    $event = $_POST['event'];
    $title = $_POST['paper_title'];
    $track = $_POST['tracks'];
    // Assuming you have member ID stored in session
    if (!isset($_SESSION['member_id'])) {
        // Redirect user to login page if not logged in
        header("Location: login.php");
        exit;
    }
    $member_id = $_SESSION['member_id'];

    // Retrieve file contents
    $paper_pdf = file_get_contents($_FILES['paper_pdf']['tmp_name']);
    $plagiarism_report = file_get_contents($_FILES['plagiarism_report']['tmp_name']);
    $presentation_pdf = file_get_contents($_FILES['PresentationPDF']['tmp_name']);
    $CRC = file_get_contents($_FILES['CRC']['tmp_name']);
    $COriginality = file_get_contents($_FILES['COriginality']['tmp_name']);
    $Copyright = file_get_contents($_FILES['Copyright']['tmp_name']);
    

    // Prepare SQL statement to insert paper details
    $sql_paper = "INSERT INTO paper (Event, Title, Track, PaperPDF, PlagiarismReport, PresentationPDF, CRC, COriginality, CopyrightTransfer, paperDate, MemberID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
$stmt_paper = $conn->prepare($sql_paper);
$stmt_paper->bind_param("sssssssssi", $event, $title, $track, $paper_pdf, $plagiarism_report, $presentation_pdf, $CRC ,  $COriginality, $Copyright, $member_id);


    // Execute the paper insertion statement
    if ($stmt_paper->execute()) {
        // Get the ID of the inserted paper
        $paper_id = $stmt_paper->insert_id;

        // Prepare SQL statement to insert author details
        $sql_author = "INSERT INTO author (PaperID, MemberID, Name, Email) VALUES (?, ?, ?, ?)";
        $stmt_author = $conn->prepare($sql_author);

        // Retrieve and insert author details for each author
        if (isset($_POST['memberID']) && isset($_POST['name']) && isset($_POST['email'])) {
            $numAuthors = count($_POST['memberID']);
            for ($i = 0; $i < $numAuthors; $i++) {
                $memberID = $_POST['memberID'][$i];
                $name = $_POST['name'][$i];
                $email = $_POST['email'][$i];

                // Bind parameters for author insertion
                $stmt_author->bind_param("iiss", $paper_id, $memberID, $name, $email);

                // Execute the author insertion statement
                $stmt_author->execute();
            }
        }

        // Close author statement
        $stmt_author->close();

        // Redirect or perform any other action after successful insertion
        $showAlert = true;
        header("Location: paperView.php");
        exit;
    } else {
        $showError = "Error: " . $stmt_paper->error; // Capture error message
    }

    // Close paper statement
    $stmt_paper->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Submit Paper</title>
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
        button#addAuthorBtn {
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size:15px;
        }

        button#addAuthorBtn:hover {
            background-color: #07273b;
            color:white;
        }

        #authorInputs {
            margin-top: 20px;

        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
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
                Submit Paper
            </a>
        </div>
        <div class="page-header-heading">
            <h1>SUBMIT PAPER</h1>
        </div>
    </div>


    <?php

    if($showAlert)
    {
       echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> Your paper is now submitted and you can view it.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
        </div>';

    }
    if($showError)
    {
       echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>'.$showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

    }

    ?>

    <div class="container">
    <h2>Submit Paper</h2>
    <form  method="POST" enctype="multipart/form-data">
        <label for="event">Select Event:</label>
        <select name="event" id="event">
            <option value="Delcon2024">Delcon2024</option>
        </select>
        <br><br>

        <label for="paper_title">Title of Paper:</label>
        <input type="text" id="paper_title" name="paper_title" required>
        <br><br>

        <label for="tracks">Select Track:</label>
        <select name="tracks" id="tracks">
            <option value="Track 1">Sustainable Computing</option>
            <option value="Track 2">High Performance Computing</option>
            <option value="Track 3">High Speed Networking and Information Security</option>
            <option value="Track 4">Software Engineering and Emerging Technologies</option>
            <option value="Track 5">Industrial and Commercial Applications of Technologies</option>
            <option value="Track 6">Devices, Circuits, Systems and VLSI Technologies</option>
            <option value="Track 7">Communications and Signal Processing</option>
            <option value="Track 8">Special Tracks: WIE, Industry, HTC, Education</option>
        </select>
        <br><br>

        <label for="paper_pdf">Upload Paper PDF:</label>
        <input type="file" id="paper_pdf" name="paper_pdf" accept=".pdf" >
        <br><br>

        <label for="plagiarism_report">Upload Plagiarism Report:</label>
        <input type="file" id="plagiarism_report" name="plagiarism_report" accept=".pdf">
        <br><br> 

        <label for="PresentationPDF">Presentation PDF:</label>
        <input type="file" id="PresentationPDF" name="PresentationPDF" accept=".pdf" >
        <br><br>

        <label for="CRC">CRC (DOC/DOCX):</label>
        <input type="file" id="CRC" name="CRC" accept=".pdf" >
        <br><br>

        <label for="COriginality">C.Originality:</label>
        <input type="file" id="COriginality" name="COriginality" accept=".pdf" >
        <br><br>

        <label for="Copyright">Copyright Transfer:</label>
        <input type="file" id="Copyright" name="Copyright" accept=".pdf" >
        <br><br>

        <button id="addAuthorBtn">Add Author</button>

<div id="authorInputs"></div>

<script>
    document.getElementById('addAuthorBtn').addEventListener('click', function() {
    var numAuthorsInput = document.createElement('input');
    numAuthorsInput.type = 'number';
    numAuthorsInput.placeholder = 'Number of Authors';
    numAuthorsInput.id = 'numAuthorsInput';

    var addAuthorsBtn = document.createElement('button');
    addAuthorsBtn.textContent = 'Add';
    addAuthorsBtn.addEventListener('click', function() {
        var numAuthors = parseInt(numAuthorsInput.value);
        if (!isNaN(numAuthors) && numAuthors > 0) {
            var authorInputs = document.getElementById('authorInputs');
            var existingAuthorsCount = authorInputs.querySelectorAll('div').length;
            var numAuthorsToAdd = numAuthors - existingAuthorsCount;

            if (numAuthorsToAdd > 0) {
                for (var i = 1; i <= numAuthorsToAdd; i++) {
                    var authorDiv = document.createElement('div');
                    var authorIndex = existingAuthorsCount + i;
                    authorDiv.innerHTML = '<h3>Author ' + authorIndex + '</h3>' +
                        '<label for="memberID' + authorIndex + '">MemberID:</label>' +
                        '<input type="text" id="memberID' + authorIndex + '" name="memberID[]" required>' +
                        '<label for="name' + authorIndex + '">Name:</label>' +
                        '<input type="text" id="name' + authorIndex + '" name="name[]" required>' +
                        '<label for="email' + authorIndex + '">Email:</label>' +
                        '<input type="email" id="email' + authorIndex + '" name="email[]" required><br><br>';
                    authorInputs.appendChild(authorDiv);
                }
            } else if (numAuthorsToAdd < 0) {
                var authorDivs = authorInputs.querySelectorAll('div');
                for (var i = numAuthors; i < existingAuthorsCount; i++) {
                    authorInputs.removeChild(authorDivs[i]);
                }
            }
        } else {
            alert('Please enter a valid number of authors.');
        }
    });

    var authorInputs = document.getElementById('authorInputs');
    authorInputs.innerHTML = ''; // Clear previous inputs
    authorInputs.appendChild(numAuthorsInput);
    authorInputs.appendChild(addAuthorsBtn);
});

</script>
  

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
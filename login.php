<?php
session_start();
include 'dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if Member ID and Password are submitted
    if (isset($_POST["txtMemberID"]) && isset($_POST["txtPassword"])) {
        // Retrieve submitted values
        $submittedMemberID = $_POST["txtMemberID"];
        $submittedPassword = $_POST["txtPassword"];

        // Prepare SQL statement
        $sql = "SELECT * FROM user WHERE MemberID = ? LIMIT 1";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $submittedMemberID);

        // Execute query
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Member ID exists, fetch associated row
            $row = $result->fetch_assoc();

            // Verify password
            if ($submittedPassword == $row['Password']) {
                // Authentication successful
                $_SESSION['member_id'] = $submittedMemberID; // Set session variable
                // Redirect to home page or any other page
                header("Location: home.php");
                exit();
            } else {
                // Authentication failed
                $errorMessage = "Invalid Password. Please try again.";
            }
        } else {
            // Member ID does not exist
            $errorMessage = "Invalid Member ID. Please try again.";
        }

        // Close statement
        $stmt->close();
    } else {
        $errorMessage = "Please enter Member ID and Password.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                Login
            </a>
        </div>
        <div class="page-header-heading">
            <h1>
                LOGIN</h1>
        </div>
    </div>

    <!-- <div class="container">
        <h1>Members, please log-in</h1>
        <form id="loginForm" name="loginForm"s method="post" onsubmit="return validateForm();">
            <div id="divMessages"></div>
            <p>
                <label for="fp1">Member ID:</label><br>
                <input type="text" name="txtMemberID" size="20" id="fp1">
                <div class="error" id="fp1Error">(Please enter your numeric Member ID allotted to you at the time of registration.)</div>	
            </p>
            <p>
                <label for="fp2">Password:</label><br>
                <input type="password" name="txtPassword" size="20" id="fp2">
            </p>
            <p>
                <input type="submit" value="Log In" name="B1">&nbsp;&nbsp;
                <input type="reset" value="Reset" name="B2">
            </p>
        </form>
        <p>
            <a href="forgotPassword.html">Forgot Your Password</a><br>
            <a href="forgotMemberId.html">Forgot Member ID</a><br>
            <a href="addMember.asp">Not a Member? Sign Up</a>
        </p>
    </div> -->


    <div class="container">
        <h1>Members, please log-in</h1>
        <form id="loginForm" name="loginForm" method="post">
            <div id="divMessages"><?php if(isset($errorMessage)) echo $errorMessage; ?></div>
            <p>
                <label for="fp1">Member ID:</label><br>
                <input type="text" name="txtMemberID" size="20" id="fp1">
                <div class="error" id="fp1Error">(Please enter your numeric Member ID allotted to you at the time of registration.)</div>
            </p>
            <p>
                <label for="fp2">Password:</label><br>
                <input type="password" name="txtPassword" size="20" id="fp2">
            </p>
            <p>
                <input type="submit" value="Log In" name="B1">&nbsp;&nbsp;
                <input type="reset" value="Reset" name="B2">
            </p>
        </form>
        <p>
            <a href="forgotPassword.php">Forgot Your Password</a><br>
            <a href="forgotMemberId.php">Forgot Member ID</a><br>
            <a href="signup.php">Not a Member? Sign Up</a>
        </p>
    </div>
        

    <footer>
    <div class="footer">
        Copyright ©2024 BVICAM , New Delhi | All rights reserved

    </div>
    </footer>
    <style href="login.js"></style>
</body>
</html>
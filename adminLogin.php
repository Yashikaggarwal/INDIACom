<?php
session_start();

// Hardcoded admin credentials (Replace this with your database logic)
$adminName = "admin";
$adminPassword = "admin123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputAdminName = $_POST['adminName'];
    $inputAdminPassword = $_POST['adminPassword'];

    // Validate admin credentials
    if ($inputAdminName === $adminName && $inputAdminPassword === $adminPassword) {
        // Successful login, set session variable
        $_SESSION['adminLoggedIn'] = true;
        header("Location: adminHome.php");
        exit;
    } else {
        // Invalid credentials, show error message
        $errorMessage = "Invalid admin name or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    

    <div class="page-header-background">
        <div class="page-header-path">
            <a href="login.html" id="home-page">
                Home
            </a>
            <p>/</p>
            <a href="login.html" id="login-page">
                Admin Login
            </a>
        </div>
        <div class="page-header-heading">
            <h1>
                ADMIN LOGIN</h1>
        </div>
    </div>

    <div class="container">
        <h1>Admins, please log-in</h1>
        <form id="loginForm" name="loginForm" method="post">
    <div id="divMessages"><?php if(isset($errorMessage)) echo $errorMessage; ?></div>
    <p>
        <label for="adminName">Admin Name:</label><br>
        <input type="text" name="adminName" size="20" id="adminName">
    </p>
    <p>
        <label for="adminPassword">Password:</label><br>
        <input type="password" name="adminPassword" size="20" id="adminPassword">
    </p>
    

            <!-- <label for="tracks">Select Track:</label>
        <select name="tracks" id="tracks">
        <option value="track1">Track 1</option>
        <option value="track2">Track 2</option>
        <option value="track3">Track 3</option>
        <option value="track4">Track 4</option>
        <option value="track5">Track 5</option>
        <option value="track6">Track 6</option>
            <option value="t1">Sustainable Computing</option>
            <option value="t2">High Performance Computing</option>
            <option value="t3">High Speed Networking and Information Security</option>
            <option value="t4">Software Engineering and Emerging Technologies</option>
            <option value="t5">Industrial and Commercial Applications of Technologies</option>
            <option value="t6">Devices, Circuits, Systems and VLSI Technologies</option>
            <option value="t7">Communications and Signal Processing</option>
            <option value="t8">Special Tracks: WIE, Industry, HTC, Education</option>
        </select> -->
        <br><br>
            </p>
            <p>
                <input type="submit" value="Log In" name="B1">&nbsp;&nbsp;
                <!-- <input type="reset" value="Reset" name="B2"> -->
            </p>
            <p>Are you a track in-charge? <a href="trackInchargeLogin.php">Login here</a></p>
        </form>
        <!-- <p>
            <a href="forgotPassword.html">Forgot Your Password</a><br>
            <a href="forgotMemberId.html">Forgot Member ID</a><br>
            <a href="addMember.asp">Not a Member? Sign Up</a>
        </p> -->
    </div>
    <footer>
        <div class="footer">
            Copyright ©2024 BVICAM , New Delhi | All rights reserved

        </div>  
    </footer>

</body>
</html>
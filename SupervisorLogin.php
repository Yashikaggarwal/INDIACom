<?php
session_start();

// Hardcoded supervisor credentials (Replace this with your database logic)
$supervisorName = "supervisor";
$supervisorPassword = "supervisor123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputSupervisorName = $_POST['supervisorName'];
    $inputSupervisorPassword = $_POST['supervisorPassword'];

    // Validate supervisor credentials
    if ($inputSupervisorName === $supervisorName && $inputSupervisorPassword === $supervisorPassword) {
        // Successful login, set session variable
        $_SESSION['supervisorLoggedIn'] = true;
        header("Location: SupervisorHome.php");
        exit;
    } else {
        // Invalid credentials, show error message
        $errorMessage = "Invalid supervisor name or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Supervisor Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="page-header-background">
        <div class="page-header-path">
            <a href="ritikaMamLogin.php" id="login-page">
                Supervisor Login
            </a>
        </div>
        <div class="page-header-heading">
            <h1>SUPERVISOR LOGIN</h1>
        </div>
    </div>

    <div class="container">
        <h1>Supervisor, please log-in</h1>
        <form id="loginForm" name="loginForm" method="post">
    <div id="divMessages"><?php if(isset($errorMessage)) echo $errorMessage; ?></div>
    <p>
        <label for="supervisorName">Supervisor Name:</label><br>
        <input type="text" name="supervisorName" size="20" id="supervisorName">
    </p>
    <p>
        <label for="supervisorPassword">Password:</label><br>
        <input type="password" name="supervisorPassword" size="20" id="supervisorPassword">
    </p>
        <br><br>
            </p>
            <p>
                <input type="submit" value="Log In" name="B1">&nbsp;&nbsp;
                <!-- <input type="reset" value="Reset" name="B2"> -->
            </p>
        </form>
    </div>
    <footer>
        <div class="footer">
            Copyright ©2024 BVICAM , New Delhi | All rights reserved

        </div>  
    </footer>

</body>
</html>
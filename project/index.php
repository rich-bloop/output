<?php
session_start();
// Redirect to dashboard if user is already logged in
if (isset($_SESSION["user"])){
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Expense Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login to Expense Manager</h2>
        <?php
        // Handle login form submission
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            require_once "database.php";
            
            // Check if email exists
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            if ($user) {
                // Verify password
                if(password_verify($password, $user["password"])){
                    $_SESSION["user"] = $user["id"];
                    header("Location: dashboard.php");
                    die();
                }else{
                    echo "<p class='error-message'>Password is incorrect</p>";
                }
            }else{
                echo "<p class='error-message'>Email does not exist</p>";
            }
        }
        ?>
        <form action="index.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login">
            </div>
        </form>
        <div>
            <p>Not registered yet? <a href="registration.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
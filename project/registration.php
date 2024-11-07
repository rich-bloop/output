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
    <title>Register - Expense Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Register New Account</h2>
        <?php
        // Handle registration form submission
        if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repeatPassword = $_POST["repeat_password"];
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Validation
            $errors = array();
            
            // Check for empty fields
            if (empty($fullName) || empty($email) || empty($password) || empty($repeatPassword)) {
                array_push($errors, "All fields are required");
            }
            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            // Check password length
            if(strlen($password) < 8){
                array_push($errors, "Password must be at least 8 characters long");
            }
            // Check if passwords match
            if($password !== $repeatPassword){
                array_push($errors, "Passwords do not match");
            }

            require_once "database.php";
            
            // Check if email already exists
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "Email already exists!");
            }

            // Display errors if any
            if(count($errors) > 0){
                foreach ($errors as $error) {
                    echo "<p class='error-message'>$error</p>";
                }
            }else{
                // Insert new user into database
                $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<p class='success-message'>Registration Successful! <a href='index.php'>Login here</a></p>";
                } else{
                    die("Something went wrong");
                }
            }
        }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" name="fullname" placeholder="Full Name:" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email:" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password:" required>
            </div>
            <div class="form-group">
                <input type="password" name="repeat_password" placeholder="Repeat Password:" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Register" name="submit">
            </div>
        </form>
        <div>
            <p>Already registered? <a href="index.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
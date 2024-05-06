<?php
session_start(); // Start session

if (!empty($_POST)) {
    // Connect to the database
    include ('includes/connect.php');
    $conn = connect();

    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepared SQL query to check user existence
    $sql = "SELECT username, password FROM log WHERE username=:username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($password, $result['password'])) {
        // Authenticated user, start session and redirect
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit(); // Stop script execution after redirection
    } else {
        // Invalid username or password, display error message
        echo "<p style='color: red;'>Invalid username or password. Please try again.</p>";
    }

    $conn = null; // Close database connection
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/crud.css">
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder="Enter your username">
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Enter your password">
            </div>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="register.php">Sign up</a></p>
        </form>
    </div>
</body>

</html>
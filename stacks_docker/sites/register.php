<?php
if (!empty($_POST)) {
    include ('includes/connect.php');
    echo "connection";
    $conn = connect();
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare the insertion query
    $requete = $conn->prepare("INSERT INTO log (email, username, password) VALUES (:email, :username, :password);");

    // Retrieve form data
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Variable name corrected from 'pwd' to 'password'

    // Bind parameters
    $requete->bindParam(':email', $email);
    $requete->bindParam(':username', $username);
    $requete->bindParam(':password', $password);

    // Execute the query
    $result = $requete->execute(); // No need to pass an array of arguments

    if ($result) {
        echo "Data has been inserted successfully.";
        header("location: welcome.php");
    } else {
        echo "Error during data insertion.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="assets/crud.css">
</head>

<body>
    <div class="login-container">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder="Enter your username">
            </div>
            <div class="input-group">
                <input type="email" id="email" name="email" placeholder="Enter your Email">
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Enter your password">
            </div>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>

</html>
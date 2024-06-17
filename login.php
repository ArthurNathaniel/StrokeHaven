<?php
include 'db.php';
session_start();

// Check if the user clicked on "Forgot Password" link
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'forgot') {
    // Display a form or initiate the password recovery process
    header("Location: password_reset.php"); // Redirect to the password reset page
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $username, $hashed_password, $role);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        header("Location: dashboard.php");
        exit();
    } else {
        // echo "Invalid username or password";
        echo "<script>alert('Invalid username or password');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="header">
        <p><span><i class="fa-solid fa-thumbtack"></i></span></p>
    </div>
    <div class="login_all">
        <div class="title">
            <h2>Login</h2>
        </div>
        <form method="POST" action="">
            <div class="forms">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="forms">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="forms">
                <button type="submit">Login</button>
            </div>
        </form>
        <div class="forms">
            <p><a href="?action=forgot">Forgot Password?</a></p>
        </div>
    </div>
</body>

</html>
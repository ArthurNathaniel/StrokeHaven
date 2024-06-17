<?php
include 'db.php';

// Initialize variables for form submission
$username = "";
$email = "";
$role = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Check if the username or email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Username or email already exists!');</script>";
    } else {
        // Proceed with registration
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $password, $email, $role);
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! Redirecting to login...');
                    window.location.href = 'login.php';</script>";
            exit();
        } else {
            echo "<script>alert('Registration failed! Please try again later.');</script>";
        }
    }

    $stmt->close();
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/register.css">
</head>

<body>
    <div class="header">
        <p><span><i class="fa-solid fa-thumbtack"></i></span></p>
    </div>
    <div class="register_all">
        <div class="title">
            <h2>Registration</h2>
        </div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="forms">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>

            <div class="forms">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="forms">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="forms">
                <input type="hidden" name="role" value="<?php echo htmlspecialchars($role); ?>">
            </div>

            <div class="forms">
                <button type="submit">Register</button>
            </div>

        </form>
    </div>
</body>

</html>
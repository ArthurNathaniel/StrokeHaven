<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update password using the reset token
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?");
    $stmt->bind_param("ss", $password, $token);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Password reset successful! You can now <a href='login.php'>login</a> with your new password.";
    } else {
        echo "Invalid or expired token.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST" action="">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <label for="password">New Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>

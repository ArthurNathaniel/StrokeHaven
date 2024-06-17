<?php
// Include database connection
include 'db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Generate a random token
    $token = bin2hex(random_bytes(32));

    // Store token in database
    $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
    $stmt->bind_param("ss", $token, $email);
    $stmt->execute();

    // Send email using EmailJS
    // Replace with your actual EmailJS credentials and template details
    $service_id = "service_j9u5joj";
    $template_id = "template_jf62r4h";
    $user_id = "0sQh5GLTw-3uT8FeE";

    $emailjs_data = array(
        'service_id' => $service_id,
        'template_id' => $template_id,
        'user_id' => $user_id,
        'template_params' => array(
            'to_email' => $email,
            'reset_link' => 'http://yourdomain.com/reset_password.php?token=' . $token
        )
    );

    // Send email request via curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.emailjs.com/api/v1.0/email/send');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($emailjs_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Handle EmailJS response (log or check for errors)
    // For simplicity, you can add basic error handling here

    echo "Password reset instructions have been sent to your email.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset</h2>
    <form method="POST" action="">
        <label for="email">Enter your email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>

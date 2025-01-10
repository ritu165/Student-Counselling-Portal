<?php
include 'db_connection.php';

$registerMessage = '';

if (isset($_POST['register'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hash
    $role = $_POST['role'];

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->execute(['username' => $username, 'email' => $email]);

    if ($stmt->rowCount() > 0) {
        $registerMessage = "Username or Email already exists!";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
        if ($stmt->execute(['username' => $username, 'email' => $email, 'password' => $password, 'role' => $role])) {
            $registerMessage = "Registration successful!";
        } else {
            $registerMessage = "Failed to register.";
        }
    }
}

header("Location: index.php");
exit();
?>

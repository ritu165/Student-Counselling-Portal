<?php
session_start();
include 'db_connection.php';

$loginMessage = '';

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Start session and store user data
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        switch ($user['role']) {
            case 'Admin':
                header("Location: /new/admin/AdminDashboard.php?role=admin");
                break;
            case 'Mentor':
                header("Location: /new/counselor/counselor.php?role=mentor");
                break;
            case 'User':
                header("Location: /new/views/dashboard.php?role=user");
                break;
        }
        exit();
    } else {
        $loginMessage = "Invalid username or password!";
    }
}

header("Location: index.php");
exit();
?>

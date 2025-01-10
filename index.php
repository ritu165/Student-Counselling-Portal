<?php
session_start();
include 'db_connection.php';

// Handle messages from login/register scripts
$loginMessage = $_SESSION['loginMessage'] ?? '';
$registerMessage = $_SESSION['registerMessage'] ?? '';

// Clear messages
unset($_SESSION['loginMessage']);
unset($_SESSION['registerMessage']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <title>Responsive Login Form</title>
    <style>
        /* Inline CSS for validation messages */
        .error-message {
            color: red;
            
            margin-top: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="login">
        <div class="login__content">
            <div class="login__img">
                <img src="/Register/removebg.png" alt="Logo">
            </div>

            <div class="login__forms">
                <!-- Login Form -->
                <form method="POST" action="login.php" class="login__registre" id="login-in">
                    <h1 class="login__title">Sign In</h1>
                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" name="username" placeholder="Username" class="login__input" required>
                    </div>
                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" placeholder="Password" class="login__input" required>
                    </div>
                    <p style="color: red;"><?php echo $loginMessage; ?></p>
                    <a href="#" class="login__forgot">Forgot password?</a>
                    <button type="submit" name="login" class="login__button">Sign In</button>
                    <div>
                        <span class="login__account">Don't have an Account?</span>
                        <span class="login__signin" id="sign-up">Sign Up</span>
                    </div>
                </form>

                <!-- Register Form -->
                <form method="POST" action="register.php" class="login__create none" id="login-up" onsubmit="return validateRegisterForm()">
                    <h1 class="login__title">Create Account</h1>
                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" name="username" placeholder="Username" class="login__input" required>
                    </div>
                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input type="email" name="email" placeholder="Email" class="login__input" required>
                    </div>
                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" placeholder="Password" class="login__input" id="register-password" required>
                    </div>
                    <p id="password-strength-error" class="error-message" style="font-size: 12px;">Password must be at least 8 characters, include uppercase, lowercase, number, and special character.</p>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" placeholder="Confirm Password" class="login__input" id="confirm-password" required>
                    </div>
                    <p id="password-error" class="error-message">Passwords do not match!</p>
                    <div class="login__box">
                        <i class='bx bx-group login__icon'></i>
                        <select name="role" class="login__input" required>
                            <option value="User">Student</option>
                            <option value="Mentor">Mentor</option>   
                        </select>
                    </div>
                    <p style="color: green;"><?php echo $registerMessage; ?></p>
                    <button type="submit" name="register" class="login__button">Sign Up</button>
                    <div>
                        <span class="login__account">Already have an Account?</span>
                        <span class="login__signup" id="sign-in">Sign In</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
    <script>
        // Validate Password Strength
        function validatePasswordStrength(password) {
            const strengthRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            return strengthRegex.test(password);
        }

        // Validate Registration Form
        function validateRegisterForm() {
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const strengthError = document.getElementById('password-strength-error');
            const matchError = document.getElementById('password-error');

            let isValid = true;

            // Check password strength
            if (!validatePasswordStrength(password)) {
                strengthError.style.display = 'block';
                isValid = false;
            } else {
                strengthError.style.display = 'none';
            }

            // Check if passwords match
            if (password !== confirmPassword) {
                matchError.style.display = 'block';
                isValid = false;
            } else {
                matchError.style.display = 'none';
            }

            return isValid;
        }

        // Real-time Validation
        document.getElementById('register-password').addEventListener('input', () => {
            const password = document.getElementById('register-password').value;
            const strengthError = document.getElementById('password-strength-error');

            if (!validatePasswordStrength(password)) {
                strengthError.style.display = 'block';
            } else {
                strengthError.style.display = 'none';
            }
        });

        document.getElementById('confirm-password').addEventListener('input', () => {
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const matchError = document.getElementById('password-error');

            if (password !== confirmPassword) {
                matchError.style.display = 'block';
            } else {
                matchError.style.display = 'none';
            }
        });
    </script>
</body>
</html>

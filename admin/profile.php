<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile - Brinware University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color:rgb(216, 213, 213);
            color: #333;
            margin: 0;
            transition: background-color 0.3s ease;
        }

        .profile-header {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: white;
            padding: 40px 20px;
            text-align: center;
            border-bottom: 5px solid #fff;
        }

        .profile-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
            max-width: 650px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #4facfe;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .profile-photo:hover {
            transform: scale(1.1);
        }

        .details-section {
            margin-top: 20px;
        }

        .details-section h5 {
            margin-bottom: 10px;
            color: #4facfe;
            font-weight: 600;
        }

        .details-section p {
            font-size: 1rem;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #4facfe;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #00f2fe;
            transform: scale(1.05);
        }

        /* Keyframe animation for fading text */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }
    </style>
</head>
<body>
    <!-- Profile Header -->
    <div class="profile-header fade-in">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Your personalized profile at Brinware University</p>
    </div>

    <!-- Profile Card -->
    <div class="profile-card">
        <div class="text-center">
            <img src="https://via.placeholder.com/120" alt="Student Photo" class="profile-photo">
            <h1><?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <p class="text-muted">[Degree Program], Class of [Year]</p>
            <button class="btn-custom">Edit Profile</button>
        </div>
        <hr>
        <div class="details-section">
            <h5>Contact Information</h5>
            <p>Email: admin.email@example.com</p>
            <p>Phone: (123) 456-7890</p>
            <hr>
            <h5>Address</h5>
            <p>123 University Avenue, City, State, ZIP</p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Brinware University. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

// Role-based access restriction
if ($_SESSION['role'] !== 'User') {
    echo "<h2>Access Denied!</h2>";
    echo "<p>You do not have permission to access this page.</p>";
    echo "<a href='dashboard.php'>Go Back</a>";
    exit();
}

// If the role is 'User', display the dashboard
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Counseling Portal</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{asset('assets/css/counselor_dashboard.css')}}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #b8cce08f;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: linear-gradient(90deg, rgba(0,123,255,1) 0%, rgba(23,162,184,1) 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #fff !important;
            font-size: 1.8rem;
            font-weight: 500;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
            padding: 10px 15px;
        }

        .navbar-nav .nav-link:hover {
            color: #000103 !important;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            background-color: #fff;
        }

        /* Sidebar Styles */
        .sidebar {
            position: absolute;
            top: 69px; /* Adjust to place below the navbar */
            left: 0;
            width: 70px; /* Start with narrow sidebar */
            height: 100%;
            background-color: #343a40;
            transition: width 0.3s ease;
            overflow-x: hidden;
            z-index: 100; /* Keep sidebar on top */
            box-shadow: 4px 0px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 15px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar a:hover {
            background-color: #007bff;
        }

        .sidebar .active {
            background-color: #007bff;
        }

        .sidebar i {
            font-size: 22px; /* Larger icons */
            margin-right: 10px;
        }

        .sidebar span {
            display: none;
            transition: opacity 0.3s ease;
        }

        /* Expand sidebar on hover */
        .sidebar:hover {
            width: 220px; /* Expand sidebar on hover */
        }

        .sidebar:hover span {
            display: inline-block; /* Show text when expanded */
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        /* Content Section */
        .content-section {
            margin-left: 70px; /* Make room for the collapsed sidebar */
            transition: margin-left 0.3s ease;
            z-index: 1;
            position: relative;
        }

        /* Modern button styles */
        .btn-custom {
            background: linear-gradient(to right, #007bff, #00c6ff); /* Gradient background */
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 30px; /* Rounded corners */
            text-transform: uppercase;
            font-weight: bold;
            transition: all 0.3s ease; /* Smooth transition */
            box-shadow: 0 4px 10px rgb(0, 4, 8); /* Soft shadow */
        }

        .btn-custom:hover {
            background: linear-gradient(to right, #00c6ff, #007bff); /* Reverse gradient on hover */
            transform: translateY(-4px); /* Lift effect */
            box-shadow: 0 8px 15px rgb(0, 6, 12); /* Darker shadow on hover */
        }

        /* Small Book Now button for counselor profiles */
        .btn-sm-custom {
            background: linear-gradient(to right, #28a745, #218838); /* Gradient background */
            color: #fff;
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 25px;
            text-transform: uppercase;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);
        }

        .btn-sm-custom:hover {
            background: linear-gradient(to right, #218838, #28a745);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(40, 167, 69, 0.5);
        }

        /* Responsiveness: Adjust layout for smaller screens */
        @media (max-width: 768px) {
            .container{
                top:-250px;
                left:-20px;
                position:relative;
                
            }
            .sidebar {
                position: relative;
                height: auto;
                width: 10%;
                margin-bottom: 20px;
                top: 0; /* Remove offset */
            }
            .content-section {
                margin-left: 0;
            }
            .navbar {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Student Counseling Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <img src="img.png" alt="Prof. Brown" class="profile-image" style="width: 50px; height: 50px;">
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/new/index.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

   <!-- Sidebar -->
<div class="sidebar">
    <a href="dashboard.php" class="active">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
    <a href="appointment.php">
        <i class="fas fa-calendar-check"></i>
        <span>Appointment</span>
    </a>
    <a href="form.php">
        <i class="fas fa-envelope"></i>
        <span>Messages</span>
    </a>
    <a href="profile.php">
        <i class="fas fa-user"></i>
        <span>Profile</span>
    </a>
    <a href="feedback.php">
        <i class="fas fa-comments"></i>
        <span>Feedback</span>
    </a>
</div>

<!-- Main Content Section -->
<div class="content-section" style="margin-left: 70px; transition: margin-left 0.3s ease; position: relative; z-index: 1;">
    <div class="container">
        <div class="row">
            <!-- Dashboard Overview -->
            <div class="col-lg-8 col-md-12 ">
                <div class="card" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);margin-top: 15px">
                    <div class="card-header" style="background-color: #007bff; color: white; font-size: 1.25rem; font-weight: 600;"><h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1></div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 1.5rem; font-weight: bold;">Your Counseling Dashboard</h5>
                        <p class="card-text" style="font-size: 1rem; color: #555;">Here you can book counseling appointments, view your sessions, and more.</p>
                        <a href="appointment.php" class="btn btn-custom">Book a Session</a>
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="card" style="margin-top: 5px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-header" style="background-color: #007bff; color: white; font-size: 1.25rem; font-weight: 600;">Upcoming Counseling Appointments</div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Dec 15</strong> - Anxiety Counseling with Dr. Smith</li>
                            <li><strong>Dec 20</strong> - Stress Management with Prof. Brown</li>
                            <li><strong>Dec 22</strong> - Career Counseling with Ms. White</li>
                        </ul>
                    </div>
                </div>

                <!-- Recent Feedback -->
                <div class="card" style="margin-top: 5px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="card-header" style="background-color: #007bff; color: white; font-size: 1.25rem; font-weight: 600;">Recent Feedback</div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Dr. Smith:</strong> "Great session on anxiety management. Very helpful!"</li>
                            <li><strong>Prof. Brown:</strong> "Really helped me with stress relief techniques."</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Counselor Profiles -->
            <div class="col-lg-4 col-md-12 ">
                <!-- Counselor List -->
                <div class="card" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-top: 15px;">
                    <div class="card-header" style="background-color: #007bff; color: white; font-size: 18px; font-weight: bold; ">
                        Available Counselors
                    </div>
                    <div class="card-body" style="padding: 20px;">
                        <div class="d-flex align-items-center mb-3" style="margin-bottom: 15px;">
                            <img src="pic1.jpg" alt="Dr. Smith" class="profile-image" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 15px;">
                            <div>
                                <h6 style="font-size: 16px; font-weight: bold; margin-bottom: 5px;">Dr. John Smith</h6>
                                <p style="font-size: 14px; color: #777;">Specialist in Anxiety and Stress Management</p>
                                <a href="#" class="btn btn-sm btn-custom" style="background-color: #71d4e7; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Book Now</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3" style="margin-bottom: 15px;">
                            <img src="pic2.jpg" alt="Prof. Brown" class="profile-image" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 15px;">
                            <div>
                                <h6 style="font-size: 16px; font-weight: bold; margin-bottom: 5px;">Prof. Emily Brown</h6>
                                <p style="font-size: 14px; color: #777;">Expert in Stress Relief Techniques</p>
                                <a href="#" class="btn btn-sm btn-custom" style="background-color: #71d4e7; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- Notifications Section (Placed Just Below the Counselor Profiles) -->
                <div class="card" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-top: 5px;">
                    <div class="card-header" style="background-color: #007bff; color: white; font-size: 18px; font-weight: bold; ">
                        Notifications
                    </div>
                    <div class="card-body" style="padding: 20px;">
                        <ul style="list-style-type: none; padding: 0;">
                            <li style="font-size: 1rem; color: #333; margin-bottom: 10px;">
                                <strong>Your appointment with Dr. Smith</strong> has been confirmed for Dec 15.
                            </li>
                            <li style="font-size: 1rem; color: #333;">
                                <strong>New feedback</strong> available for your last session with Prof. Brown.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

           
           
        </div>
    </div>
</div>
<script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
    <script src="https://files.bpcontent.cloud/2024/11/27/15/20241127152855-LD9P4EHV.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
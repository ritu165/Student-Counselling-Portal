<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: /new/index.php");
    exit();
}

// Role-based access restriction
if ($_SESSION['role'] !== 'Admin') {
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
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #b8cce08f;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: linear-gradient(90deg, rgba(255,0,0,1) 0%, rgba(255,99,71,1) 100%);
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
            top: 69px;
            left: 0;
            width: 70px;
            height: 100%;
            background-color: #343a40;
            transition: width 0.3s ease;
            overflow-x: hidden;
            z-index: 100;
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
            background-color: #ff6347;
        }

        .sidebar .active {
            background-color: #ff6347;
        }

        .sidebar i {
            font-size: 22px;
            margin-right: 10px;
        }

        .sidebar span {
            display: none;
            transition: opacity 0.3s ease;
        }

        .sidebar:hover {
            width: 220px;
        }

        .sidebar:hover span {
            display: inline-block;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .content-section {
            margin-left: 70px;
            transition: margin-left 0.3s ease;
            z-index: 1;
            position: relative;
        }

        /* Modern button styles */
        .btn-custom {
            background: linear-gradient(to right, #ff6347, #ff4500);
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 30px;
            text-transform: uppercase;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgb(0, 4, 8);
        }

        .btn-custom:hover {
            background: linear-gradient(to right, #ff4500, #ff6347);
            transform: translateY(-4px);
            box-shadow: 0 8px 15px rgb(0, 6, 12);
        }

        /* Chart Container */
        .chart-container {
            text-align: center;
        }

        /* Line Chart Styling */
        .chart-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
        }

        .chart {
            width: 100%;
            height: 250px;
        }

        h2 {
            margin-left: -105px;
        }

        /* Media Queries for Responsiveness */
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
                margin-left: 250px;
            }

            .navbar .container-fluid {
                padding-left: 10px;
                padding-right: 10px;
            }

            .chart-wrapper {
                flex-direction: column;
            }

            .chart {
                width: 100% !important;
                height: 300px;
            }
        }

        /* Small screens */
        @media (max-width: 576px) {
            .navbar .navbar-brand {
                font-size: 1.5rem;
            }

            .content-section {
                margin-left: 0;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: static;
            }

            .sidebar a {
                padding: 12px;
                text-align: center;
                font-size: 14px;
            }

            .chart-wrapper {
                flex-direction: column;
            }

            .chart {
                width: 100%;
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/new/admin/about.php">About us</a>
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
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <a href="/new/counselor/request.php">
            <i class="fas fa-calendar-check"></i>
            <span>Total Requests</span>
        </a>
        <a href="teacher.php">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Teacher</span>
        </a>
        <a href="student.php">
            <i class="fas fa-user-graduate"></i>
            <span>Student</span>
        </a>
        <a href="admin.php">
            <i class="fas fa-users-cog"></i>
            <span>Admin</span>
        </a>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <div class="container">
            <div class="row">
                <!-- Admin Dashboard Overview -->
                <div class="col-lg-8 col-md-12" style="width: 55%;">
                    <div class="card" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-top: 15px;">
                        <div class="card-header" style="background-color: #ff6347; color: white; font-size: 1.25rem; font-weight: 600;"><h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1></div>
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 1.5rem; font-weight: bold;">Admin Dashboard Overview &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="student.php" class="btn btn-custom" style="padding: 8px 12px;">Manage Users</a>
                            </h5>
                            <p class="card-text" style="font-size: 1rem; color: #555;">Manage users, appointments, and oversee counselors and feedback.</p>
                        </div>
                    </div>

                    <!-- Line Chart for Receive and Solve Queries -->
                    <div class="card" style="border-radius: 10px; margin-top: 20px;">
                        <div class="card-header" style="background-color: #ff6347; color: white;">Queries Overview</div>
                        <div class="card-body">
                            <div class="chart-container">
                                <h2 class="t1" style="font-size: 1.5rem; font-weight: bold;">Receive and Solve Queries</h2>
                                <div class="chart-wrapper">
                                    <div class="chart">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Management Section -->
                <div class="col-lg-4 col-md-12" style="width: 45%;">
                    <div class="card" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-top: 15px;">
                        <div class="card-header" style="background-color: #ff6347; color: white; font-size: 18px; font-weight: bold;">
                            Admin Notifications
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <ul style="list-style-type: none; padding: 0;">
                                <li style="font-size: 1rem; color: #333; margin-bottom: 10px;">
                                    <strong>User request</strong> from John Doe for counselor registration.
                                </li>
                                <li style="font-size: 1rem; color: #333;">
                                    <strong>New feedback</strong> available for counseling sessions.
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bar Chart for Girls and Boys Queries -->
                    <div class="card" style="border-radius: 10px; margin-top: 20px;">
                        <div class="card-header" style="background-color: #ff6347; color: white;">Girls vs Boys Queries</div>
                        <div class="card-body">
                            <div class="chart-container">
                                <h2 class="t2" style="font-size: 1.5rem; font-weight: bold;">Girls and Boys Queries</h2>
                                <div class="chart-wrapper">
                                    <div class="chart">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Line Chart Data and Configuration
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Receive Queries',
                    data: [12, 19, 3, 5, 2, 3, 12, 15, 9, 8, 6, 11],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Solve Queries',
                    data: [5, 9, 6, 3, 1, 2, 8, 12, 4, 7, 3, 10],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Queries'
                        }
                    }
                }
            }
        });

        // Bar Chart Data and Configuration
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Girls Queries',
                    data: [10, 12, 5, 7, 8, 6, 14, 9, 10, 12, 11, 13],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Boys Queries',
                    data: [8, 9, 4, 5, 6, 7, 13, 11, 8, 9, 10, 12],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Queries'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
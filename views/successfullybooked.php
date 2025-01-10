<?php
// Include database connection
include 'db.php';

// Fetch details for the booked appointment
$appointment_id = $_GET['appointment_id'] ?? null;

if ($appointment_id) {
    // Fetch the details of the booked appointment
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE id = ?");
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment = $result->fetch_assoc();

    if ($appointment) {
        // Display booking success message
        $success_message = "Booking Successful! Your appointment with " . $appointment['counselor_name'] . " is scheduled for " . $appointment['appointment_date'] . " at " . $appointment['appointment_time'] . ".";
    } else {
        $error_message = "Appointment not found.";
    }
} else {
    $error_message = "Invalid appointment ID.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #d2cccc;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 30px;
            padding: 12px 25px;
            width: 75%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Booking Confirmation</h3>

        <!-- Display Success or Error Message -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Button to Go Back to Appointments -->
        <a href="appointment.php" class="btn btn-custom">Go to My Appointments</a>
    </div>
</body>
</html>

<?php
// Include the database connection file
include 'db.php'; // Include db.php to establish a connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $counselor = $_POST['counselor'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $notes = $_POST['notes'];

    // Fetch counselor details based on selected counselor ID
    $stmt = $conn->prepare("SELECT * FROM counselors WHERE id = ?");
    $stmt->bind_param("i", $counselor);
    $stmt->execute();
    $result = $stmt->get_result();
    $counselor_data = $result->fetch_assoc();

    // If counselor exists, proceed to save the appointment
    if ($counselor_data) {
        // Insert appointment into the database
        $stmt = $conn->prepare("INSERT INTO appointments (counselor_id, counselor_name, appointment_date, appointment_time, notes) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $counselor, $counselor_data['name'], $date, $time, $notes);
        
        // Check if the insert was successful
        if ($stmt->execute()) {
            // Get the last inserted appointment ID
            $appointment_id = $stmt->insert_id;

            // Redirect to the confirmation page
            header("Location: successfullybooked.php?appointment_id=" . $appointment_id);
            exit();
        } else {
            $error_message = "There was an error booking the appointment. Please try again.";
        }
    } else {
        $error_message = "Counselor not found.";
    }

    // Close the prepared statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Counseling Portal - Appointments</title>
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
            background-color: #d2cccc;
            padding: 20px;
            transition: background-color 0.3s ease;
        }
       
        .container {
            max-width: 700px;
            margin: auto;
            background-color: #fff;
            padding: 4px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 3px solid transparent;
            background-image: linear-gradient(white, white), radial-gradient(circle at top left, #6a11cb, #48d2f8);
            background-origin: border-box;
            background-clip: content-box, border-box;
            transition: all 0.3s ease;
        }

        .container:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        h3 {
            margin-top: 18px;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
        }

        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 10px; /* Added margin for spacing between label and input */
        }

        .form-control {
            padding: 12px 15px; /* Increased padding for more space inside input fields */
            margin-bottom: 20px; /* Space between fields */
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 30px;
            padding: 12px 25px;
            margin-left: 12.5%;
            width: 75%;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
            transform: translateY(-3px);
        }

        .appointments-list {
            margin-top: 40px;
        }

        .appointment-card {
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .appointment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .appointment-card h5 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        .appointment-card p {
            margin: 0;
            color: #605e5e;
        }

        .space {
            margin: 0 10px;
            padding: 0 10px;
        }

        .error-message {
            color: red;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Book an Appointment</h3>

        <!-- Display error message if any -->
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="appointment.php">
            <!-- Counselor Selection -->
            <div class="mb-3 space">
                <label for="counselor" class="form-label">Select Counselor</label>
                <select class="form-select" id="counselor" name="counselor" required>
                    <option selected disabled>Choose...</option>
                    <option value="1">Dr. John Smith - Anxiety Specialist</option>
                    <option value="2">Prof. Emily Brown - Stress Management</option>
                    <option value="3">Ms. Sarah White - Career Counseling</option>
                </select>
            </div>

            <!-- Date Selection -->
            <div class="mb-3 space">
                <label for="date" class="form-label">Select Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <!-- Time Selection -->
            <div class="mb-3 space">
                <label for="time" class="form-label">Select Time</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>

            <!-- Notes -->
            <div class="mb-3 space">
                <label for="notes" class="form-label">Additional Notes (optional)</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter any additional details..."></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-custom">Book Appointment</button>
            <br>
            <br>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

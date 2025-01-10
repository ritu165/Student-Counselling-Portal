<?php
include 'db.php'; // Include the database connection file

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $student_code = $_POST['student-code'];
    $student_name = $_POST['student-name'];
    $gmail = $_POST['gmail'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $counselor_id = $_POST['counselor_id'];
    $problems = isset($_POST['problem']) ? implode(', ', $_POST['problem']) : ''; // Store selected problems
    $problem_description = $_POST['describe-problem'];
    $schedule_type = $_POST['schedule'];

    // Insert the data into the database
    $stmt = $conn->prepare("INSERT INTO student_issues (student_code, student_name, gmail, phone, department, counselor_id, problems, problem_description, schedule_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $student_code, $student_name, $gmail, $phone, $department, $counselor_id, $problems, $problem_description, $schedule_type);

    if ($stmt->execute()) {
        // Redirect to the successfully.php page after successful submission
        header("Location: successfully.php");
        exit; // Ensure no further code is executed
    } else {
        echo "<div class='text-center text-red-500 font-semibold'>Error: " . $stmt->error . "</div>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Set initial countdown value
        let countdown = 5;

        // Function to update countdown every second
        const countdownInterval = setInterval(function () {
            document.getElementById("countdown").innerText = countdown; // Update countdown display
            countdown--; // Decrease countdown by 1

            // When countdown reaches 0, clear interval and redirect
            if (countdown < 0) {
                clearInterval(countdownInterval); // Stop the countdown
                window.location.href = 'dashboard.php'; // Redirect to dashboard page
            }
        }, 1000); // 1000 milliseconds = 1 second
    </script>
</head>

<body class="bg-gray-300 py-10">

    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg text-center">
        <h2 class="text-2xl font-semibold text-green-500 mb-6">Form Submitted Successfully!</h2>
        <p class="text-gray-700">You will be redirected to the dashboard in <span id="countdown">5</span> seconds...</p>
    </div>

</body>

</html>

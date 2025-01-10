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
        // Redirect to dashboard.php after successful submission
        header("Location: formsuccessfully.php");
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

<!-- Form HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Issue Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-300 py-10">

    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Student Issue Form</h2>

        <form action="" method="POST"> <!-- Submit to the current page -->

            <!-- Student Code -->
            <div class="mb-4">
                <label for="student-code" class="block text-sm font-medium text-gray-700">Student Code</label>
                <input type="text" id="student-code" name="student-code" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="BWU/BTD/21/014" required>
            </div>

            <!-- Student Name -->
            <div class="mb-4">
                <label for="student-name" class="block text-sm font-medium text-gray-700">Student Name</label>
                <input type="text" id="student-name" name="student-name" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
            </div>

            <!-- Gmail -->
            <div class="mb-4">
                <label for="gmail" class="block text-sm font-medium text-gray-700">Gmail</label>
                <input type="email" id="gmail" name="gmail" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required placeholder="example@gmail.com">
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required placeholder="(+91) xxxxxxxxxx">
            </div>

            <!-- Department -->
            <div class="mb-4">
                <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                <input type="text" id="department" name="department" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
            </div>

            <!-- Select Mentor (Dropdown) -->
            <div class="mb-4">
                <label for="counselor_id" class="block text-sm font-medium text-gray-700">Select Counselor</label>
                <select id="counselor_id" name="counselor_id" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
                    <option value="" disabled selected>Select a Counselor</option>
                    <option value="1">Dr. John Smith</option>
                    <option value="2">Prof. Emily Brown</option>
                    <option value="3">Ms. Sarah White</option>
                </select>
            </div>

            <!-- Checkboxes for Issues -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Select Problem(s)</label>
                <div class="flex items-center">
                    <input type="checkbox" id="academic-problem" name="problem[]" value="Academic Problem" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="academic-problem" class="ml-2 text-sm text-gray-700">Academic Problem</label>
                </div>
                <div class="flex items-center mt-2">
                    <input type="checkbox" id="mental-health" name="problem[]" value="Mental Health" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="mental-health" class="ml-2 text-sm text-gray-700">Mental Health</label>
                </div>
            </div>

            <!-- Describe Problem -->
            <div class="mb-4">
                <label for="describe-problem" class="block text-sm font-medium text-gray-700">Describe the Problem</label>
                <textarea id="describe-problem" name="describe-problem" rows="4" class="mt-1 p-2 w-full border border-gray-300 rounded-md" placeholder="Please describe the problem..." required></textarea>
            </div>

            <!-- Schedule Type -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Schedule Type</label>
                <div class="flex items-center">
                    <input type="radio" id="online" name="schedule" value="Online" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                    <label for="online" class="ml-2 text-sm text-gray-700">Online</label>
                </div>
                <div class="flex items-center mt-2">
                    <input type="radio" id="offline" name="schedule" value="Offline" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                    <label for="offline" class="ml-2 text-sm text-gray-700">Offline</label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit</button>
            </div>
        </form>
    </div>

</body>

</html>

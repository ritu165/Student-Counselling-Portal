<?php
include 'db.php'; // Include the database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $std_code = $_POST['std_code'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    // Insert feedback data into the database
    $stmt = $conn->prepare("INSERT INTO feedback (name, std_code, rating, feedback_text) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $std_code, $rating, $feedback);

    if ($stmt->execute()) {
        $success_message = "Feedback submitted successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Brinware University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d2cccc;
            color: #333;
            margin: 0;
        }
        .feedback-header {
            background: linear-gradient(to right, #402ae1, #00f2fe);
            color: white;
            padding: 40px 20px;
            text-align: center;
            border-bottom: 5px solid #fff;
        }
        .feedback-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
            border: 6px solid;
            border-image: linear-gradient(to right, #71d4e7, #4e69d5) 1;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Feedback Header -->
    <div class="feedback-header">
        <h1>We Value Your Feedback</h1>
        <p>Your opinions help us improve Brinware University</p>
    </div>

    <!-- Feedback Form -->
    <div class="feedback-card">
        <?php
        if (isset($success_message)) {
            echo "<div class='alert alert-success'>$success_message</div>";
        } elseif (isset($error_message)) {
            echo "<div class='alert alert-danger'>$error_message</div>";
        }
        ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="std_code" class="form-label">STD CODE</label>
                <input type="text" class="form-control" id="std_code" name="std_code" placeholder="BWU/BTD/21/014" required>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select class="form-select" id="rating" name="rating" required>
                    <option value="" disabled selected>Choose a rating</option>
                    <option value="5">Excellent</option>
                    <option value="4">Very Good</option>
                    <option value="3">Good</option>
                    <option value="2">Fair</option>
                    <option value="1">Poor</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="feedback" class="form-label">Your Feedback</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="5" placeholder="Share your thoughts..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit Feedback</button>
            <br>
            <br>
            
            <a href="dashboard.php" style="text-decoration: none;">
    <button type="button" class="btn btn-primary w-100">Back</button>
</a>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Brinware University. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

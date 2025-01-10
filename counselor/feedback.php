<?php
include '../views/db.php'; // Include the database connection file

// Fetch all feedback from the database
$stmt = $conn->prepare("
    SELECT id, name, std_code, rating, feedback_text, created_at 
    FROM feedback
    ORDER BY created_at DESC
");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Records - Brinware University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
        }
        .feedback-header {
            background: linear-gradient(to right, #4e69d5, #71d4e7);
            color: white;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .feedback-table {
            max-width: 95%;
            margin: 0 auto;
            overflow-x: auto;
        }
        .feedback-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .feedback-table th, .feedback-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .feedback-table th {
            background-color: #4e69d5;
            color: white;
        }
        .feedback-table tbody tr:hover {
            background-color: #f1f1f1;
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

    <!-- Header -->
    <div class="feedback-header">
        <h1>Student Feedback Records</h1>
        <p>All submitted feedback from students</p>
    </div>

    <!-- Feedback Table -->
    <div class="feedback-table">
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>STD Code</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['std_code']); ?></td>
                            <td>
                                <?php
                                $rating = (int)$row['rating'];
                                echo str_repeat('⭐', $rating);
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['feedback_text']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center text-muted">No feedback records found.</p>
        <?php endif; ?>

        <?php
        $stmt->close();
        $conn->close();
        ?>
    </div>

    <div class="text-center mt-4">
        <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Brinware University. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

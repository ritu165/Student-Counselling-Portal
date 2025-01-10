<?php
// Include the database connection file
include '../views/db.php'; // Adjust this path as needed

// Fetch appointments
$stmt = $conn->prepare("
    SELECT a.id, c.name AS counselor_name, a.appointment_date, a.appointment_time, a.notes 
    FROM appointments a 
    JOIN counselors c ON a.counselor_id = c.id
    ORDER BY a.appointment_date DESC, a.appointment_time DESC
");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #d2cccc;
            padding: 20px;
            transition: background-color 0.3s ease;
        }
       
        .container {
            max-width: 900px;
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

        .table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #4a4e69;
            color: #ffffff;
            text-align: center;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
        }

        .error-message {
            color: red;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <h3>All Appointment Requests</h3>

        <div class="table-responsive">
            <?php if ($result->num_rows > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Counselor Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['counselor_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                                <td><?php echo htmlspecialchars($row['notes']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="alert alert-info">No appointment requests found.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

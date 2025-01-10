<?php
// Include the database connection file
include '../views/db.php'; // Adjust path as needed

// Fetch appointment records from the database
$stmt = $conn->prepare("
    SELECT a.id, a.appointment_date, a.appointment_time, a.notes, 
           c.name AS counselor_name, 
           s.student_name, s.student_code, s.gmail, s.phone
    FROM appointments a
    JOIN counselors c ON a.counselor_id = c.id
    JOIN student_issues s ON a.counselor_id = s.counselor_id
");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Records</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
       /* General Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f3f4f6;
    margin: 0;
    padding: 0;
}

/* Container Styles */
.container {
    max-width: 1200px;
    margin: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border: 2px solid #e2e8f0;
}

/* Table Styles */
.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table thead {
    background-color: #007bff;
    color: #fff;
    text-align: left;
}

table thead th {
    padding: 12px 10px;
    font-size: 0.95rem;
    border-bottom: 2px solid #ddd;
}

table tbody tr {
    border-bottom: 1px solid #eaeaea;
}

table tbody tr:nth-child(even) {
    background-color: #f9fafc;
}

table tbody tr:hover {
    background-color: #f1f5f9;
}

table td {
    padding: 10px;
    font-size: 0.9rem;
    color: #555;
    text-align: center;
}

/* Mobile Responsive Styles */
@media (max-width: 768px) {
    /* Hide table header */
    table thead {
        display: none;
    }

    /* Transform table into block elements */
    table, table tbody, table tr, table td {
        display: block;
        width: 100%;
    }

    table tr {
        margin-bottom: 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 10px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
    }

    table td:last-child {
        border-bottom: none;
    }

    table td::before {
        content: attr(data-label);
        font-weight: 600;
        text-transform: capitalize;
        color: #374151;
        flex: 1;
    }

    table td span {
        flex: 2;
        text-align: right;
        color: #4b5563;
    }

    /* Add hover effect */
    table tr:hover {
        background-color: #f9fafb;
    }
}


/* Button Styling */
.btn-custom {
    background-color: #007bff;
    color: white;
    border-radius: 25px;
    padding: 10px 20px;
    text-align: center;
    display: inline-block;
    margin-top: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-custom:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}


    </style>
</head>
<body class="bg-gray-100 py-10">

    <div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Appointment Records</h2>

        <div class="table-container">
            <?php if ($result->num_rows > 0): ?>
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Student Name</th>
                            <th class="border border-gray-300 px-4 py-2">Student Code</th>
                            <th class="border border-gray-300 px-4 py-2">Gmail</th>
                            <th class="border border-gray-300 px-4 py-2">Phone</th>
                            <th class="border border-gray-300 px-4 py-2">Counselor</th>
                            <th class="border border-gray-300 px-4 py-2">Date</th>
                            <th class="border border-gray-300 px-4 py-2">Time</th>
                            <th class="border border-gray-300 px-4 py-2">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-100">
                            <td data-label="ID"><span><?php echo htmlspecialchars($row['id']); ?></span></td>
<td data-label="Student Name"><span><?php echo htmlspecialchars($row['student_name']); ?></span></td>
<td data-label="Student Code"><span><?php echo htmlspecialchars($row['student_code']); ?></span></td>
<td data-label="Gmail"><span><?php echo htmlspecialchars($row['gmail']); ?></span></td>
<td data-label="Phone"><span><?php echo htmlspecialchars($row['phone']); ?></span></td>
<td data-label="Counselor"><span><?php echo htmlspecialchars($row['counselor_name']); ?></span></td>
<td data-label="Date"><span><?php echo htmlspecialchars($row['appointment_date']); ?></span></td>
<td data-label="Time"><span><?php echo htmlspecialchars($row['appointment_time']); ?></span></td>
<td data-label="Notes"><span><?php echo htmlspecialchars($row['notes']); ?></span></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center text-gray-500">No appointment records found.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php
    $stmt->close();
    $conn->close();
    ?>

</body>
</html>

<?php
session_start();
include '../db_connection.php';

// Check if the user is logged in and has the necessary role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    echo "<h2>Access Denied!</h2>";
    echo "<p>You do not have permission to access this page.</p>";
    exit();
}

// Handle Create, Update, and Delete Operations
if (isset($_POST['add_mentor'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hash
    $role = 'Mentor';

    // Insert new mentor
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
    if ($stmt->execute(['username' => $username, 'email' => $email, 'password' => $password, 'role' => $role])) {
        $registerMessage = "Mentor registered successfully!";
    } else {
        $registerMessage = "Failed to register mentor.";
    }
}

if (isset($_POST['edit_mentor'])) {
    $id = $_POST['id'];
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);

    // Update mentor details
    $stmt = $conn->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
    if ($stmt->execute(['username' => $username, 'email' => $email, 'id' => $id])) {
        $updateMessage = "Mentor updated successfully!";
    } else {
        $updateMessage = "Failed to update mentor.";
    }
}

if (isset($_POST['delete_mentor'])) {
    $id = $_POST['id'];

    // Delete mentor
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    if ($stmt->execute(['id' => $id])) {
        $deleteMessage = "Mentor deleted successfully!";
    } else {
        $deleteMessage = "Failed to delete mentor.";
    }
}

// Fetch all mentors with role 'Mentor'
$query = "SELECT id, username, email, role FROM users WHERE role = 'Mentor'";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h1, h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .message {
            margin: 10px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .message.success {
            border-color: #4CAF50;
            background-color: #e7f8e7;
        }

        .message.error {
            border-color: #f44336;
            background-color: #f8e7e7;
        }
    </style>
</head>
<body>
    <h1>Mentor Management</h1>

    <!-- Add Mentor Form -->
    <h2>Add Mentor</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="add_mentor">Add Mentor</button>
    </form>

    <!-- Display Mentors -->
    <h2>Mentor List</h2>
    <?php if (isset($registerMessage)) { echo "<div class='message success'>$registerMessage</div>"; } ?>
    <?php if (isset($updateMessage)) { echo "<div class='message success'>$updateMessage</div>"; } ?>
    <?php if (isset($deleteMessage)) { echo "<div class='message success'>$deleteMessage</div>"; } ?>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->rowCount() > 0): ?>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td>
                            <!-- Edit Form -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                                <button type="submit" name="edit_mentor">Edit</button>
                            </form>

                            <!-- Delete Form -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_mentor" onclick="return confirm('Are you sure you want to delete this mentor?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No mentors found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="AdminDashboard.php">Back to Dashboard</a>
</body>
</html>

<?php
// No need for manual connection close as PDO automatically does this when the script ends.
?>

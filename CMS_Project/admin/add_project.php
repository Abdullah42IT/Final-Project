<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

require_once '../includes/database.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $start_date = htmlspecialchars($_POST['start_date']);
    $end_date = htmlspecialchars($_POST['end_date']);
    $description = htmlspecialchars($_POST['description']);

    // Insert the new project into the database
    $stmt = $pdo->prepare("INSERT INTO projects (name, start_date, end_date, description) VALUES (:name, :start_date, :end_date, :description)");
    $stmt->execute(['name' => $name, 'start_date' => $start_date, 'end_date' => $end_date, 'description' => $description]);

    // Redirect to admin dashboard
    header('Location: index.php');
    exit;
}

include '../theme/header.php';
?>

<h2>Add New Project</h2>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" required><br>

    <label>Start Date:</label><br>
    <input type="date" name="start_date" required><br>

    <label>End Date:</label><br>
    <input type="date" name="end_date" required><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br>

    <button type="submit">Add Project</button>
</form>

<a href="index.php">Back to Admin Dashboard</a>

<?php include '../theme/footer.php'; ?>

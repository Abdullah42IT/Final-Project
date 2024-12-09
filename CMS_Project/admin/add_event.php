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
    $date = htmlspecialchars($_POST['date']);
    $location = htmlspecialchars($_POST['location']);
    $description = htmlspecialchars($_POST['description']);

    // Insert the new event into the database
    $stmt = $pdo->prepare("INSERT INTO events (name, date, location, description) VALUES (:name, :date, :location, :description)");
    $stmt->execute(['name' => $name, 'date' => $date, 'location' => $location, 'description' => $description]);

    // Redirect to admin dashboard
    header('Location: index.php');
    exit;
}

include '../theme/header.php';
?>

<h2>Add New Event</h2>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" required><br>

    <label>Date:</label><br>
    <input type="date" name="date" required><br>

    <label>Location:</label><br>
    <input type="text" name="location" required><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br>

    <button type="submit">Add Event</button>
</form>

<a href="index.php">Back to Admin Dashboard</a>

<?php include '../theme/footer.php'; ?>

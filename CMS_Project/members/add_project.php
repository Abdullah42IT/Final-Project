<?php
session_start();

// Check if the user is logged in and is a member
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: /auth/login.php');
    exit;
}

require_once '../includes/database.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $status = htmlspecialchars($_POST['status']);

    // Insert data into the database
    $stmt = $pdo->prepare("INSERT INTO projects (name, description, status, created_by)
                           VALUES (:name, :description, :status, :created_by)");
    $stmt->execute([
        'name' => $name,
        'description' => $description,
        'status' => $status,
        'created_by' => $_SESSION['user_id']
    ]);

    // Redirect back to the index page after successful insertion
    header('Location: index.php');
    exit;
}

include '../theme/header.php';
?>

<h2>Add a New Project</h2>

<form method="POST">
    <label for="name">Project Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>

    <label for="status">Status:</label>
    <input type="text" name="status" id="status" required>

    <button type="submit">Add Project</button>
</form>

<?php include '../theme/footer.php'; ?>

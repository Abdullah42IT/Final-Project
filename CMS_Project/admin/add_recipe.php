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
    $ingredients = htmlspecialchars($_POST['ingredients']);
    $instructions = htmlspecialchars($_POST['instructions']);

    // Insert the new recipe into the database
    $stmt = $pdo->prepare("INSERT INTO recipes (name, ingredients, instructions) VALUES (:name, :ingredients, :instructions)");
    $stmt->execute(['name' => $name, 'ingredients' => $ingredients, 'instructions' => $instructions]);

    // Redirect to admin dashboard
    header('Location: index.php');
    exit;
}

include '../theme/header.php';
?>

<h2>Add New Recipe</h2>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" required><br>

    <label>Ingredients:</label><br>
    <textarea name="ingredients" required></textarea><br>

    <label>Instructions:</label><br>
    <textarea name="instructions" required></textarea><br>

    <button type="submit">Add Recipe</button>
</form>

<a href="index.php">Back to Admin Dashboard</a>

<?php include '../theme/footer.php'; ?>

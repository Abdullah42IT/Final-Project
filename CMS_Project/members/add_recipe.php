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
    $ingredients = htmlspecialchars($_POST['ingredients']);
    $instructions = htmlspecialchars($_POST['instructions']);

    // Insert data into the database
    $stmt = $pdo->prepare("INSERT INTO recipes (name, description, ingredients, instructions, created_by)
                           VALUES (:name, :description, :ingredients, :instructions, :created_by)");
    $stmt->execute([
        'name' => $name,
        'description' => $description,
        'ingredients' => $ingredients,
        'instructions' => $instructions,
        'created_by' => $_SESSION['user_id']
    ]);

    // Redirect back to the index page after successful insertion
    header('Location: index.php');
    exit;
}

include '../theme/header.php';
?>

<h2>Add a New Recipe</h2>

<form method="POST">
    <label for="name">Recipe Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>

    <label for="ingredients">Ingredients:</label>
    <textarea name="ingredients" id="ingredients" required></textarea>

    <label for="instructions">Instructions:</label>
    <textarea name="instructions" id="instructions" required></textarea>

    <button type="submit">Add Recipe</button>
</form>

<?php include '../theme/footer.php'; ?>

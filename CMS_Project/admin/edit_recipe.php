<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

require_once '../includes/database.php';

// Get the recipe id from URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Fetch the recipe details from the database
    $stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $recipe = $stmt->fetch();

    // If the recipe doesn't exist, redirect back to the list
    if (!$recipe) {
        header('Location: index.php');
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $ingredients = htmlspecialchars($_POST['ingredients']);
        $instructions = htmlspecialchars($_POST['instructions']);

        // Update the recipe in the database
        $stmt = $pdo->prepare("UPDATE recipes SET name = :name, ingredients = :ingredients, instructions = :instructions WHERE id = :id");
        $stmt->execute(['name' => $name, 'ingredients' => $ingredients, 'instructions' => $instructions, 'id' => $id]);

        // Redirect to admin dashboard
        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}

include '../theme/header.php';
?>

<h2>Edit Recipe</h2>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($recipe['name']); ?>" required><br>

    <label>Ingredients:</label><br>
    <textarea name="ingredients" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea><br>

    <label>Instructions:</label><br>
    <textarea name="instructions" required><?php echo htmlspecialchars($recipe['instructions']); ?></textarea><br>

    <button type="submit">Update Recipe</button>
</form>

<a href="index.php">Back to Admin Dashboard</a>

<?php include '../theme/footer.php'; ?>

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
    $title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $year = (int)$_POST['year'];

    // Insert the new book into the database
    $stmt = $pdo->prepare("INSERT INTO books (title, author, year) VALUES (:title, :author, :year)");
    $stmt->execute(['title' => $title, 'author' => $author, 'year' => $year]);

    // Redirect to admin dashboard
    header('Location: index.php');
    exit;
}

include '../theme/header.php';
?>

<h2>Add New Book</h2>

<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" required><br>

    <label>Author:</label><br>
    <input type="text" name="author" required><br>

    <label>Year:</label><br>
    <input type="number" name="year" required><br>

    <button type="submit">Add Book</button>
</form>

<a href="index.php">Back to Admin Dashboard</a>

<?php include '../theme/footer.php'; ?>

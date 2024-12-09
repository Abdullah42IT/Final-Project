<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

require_once '../includes/database.php';

// Get the book id from URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Fetch the book details from the database
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $book = $stmt->fetch();

    // If the book doesn't exist, redirect back to the list
    if (!$book) {
        header('Location: index.php');
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = htmlspecialchars($_POST['title']);
        $author = htmlspecialchars($_POST['author']);
        $year = (int)$_POST['year'];

        // Update the book in the database
        $stmt = $pdo->prepare("UPDATE books SET title = :title, author = :author, year = :year WHERE id = :id");
        $stmt->execute(['title' => $title, 'author' => $author, 'year' => $year, 'id' => $id]);

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

<h2>Edit Book</h2>

<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required><br>

    <label>Author:</label><br>
    <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required><br>

    <label>Year:</label><br>
    <input type="number" name="year" value="<?php echo htmlspecialchars($book['year']); ?>" required><br>

    <button type="submit">Update Book</button>
</form>

<a href="index.php">Back to Admin Dashboard</a>

<?php include '../theme/footer.php'; ?>

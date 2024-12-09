<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

require_once '../includes/database.php';

// Get the movie id from URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Fetch the movie details from the database
    $stmt = $pdo->prepare("SELECT * FROM movies WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $movie = $stmt->fetch();

    // If the movie doesn't exist, redirect back to the list
    if (!$movie) {
        header('Location: index.php');
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = htmlspecialchars($_POST['title']);
        $director = htmlspecialchars($_POST['director']);
        $year = (int)$_POST['year'];

        // Update the movie in the database
        $stmt = $pdo->prepare("UPDATE movies SET title = :title, director = :director, year = :year WHERE id = :id");
        $stmt->execute(['title' => $title, 'director' => $director, 'year' => $year, 'id' => $id]);

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

<h2>Edit Movie</h2>

<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>" required><br>

    <label>Director:</label><br>
    <input type="text" name="director" value="<?php echo htmlspecialchars($movie['director']); ?>" required><br>

    <label>Year:</label><br>
    <input type="number" name="year" value="<?php echo htmlspecialchars($movie['year']); ?>" required><br>

    <button type="submit">Update Movie</button>
</form>

<a href="index.php">Back to Admin Dashboard</a>

<?php include '../theme/footer.php'; ?>

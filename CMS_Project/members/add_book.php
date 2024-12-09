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
    $title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $genre_id = (int)$_POST['genre_id'];
    $published_date = $_POST['published_date'];

    // Insert data into the database
    $stmt = $pdo->prepare("INSERT INTO books (title, author, genre_id, published_date, created_by)
                           VALUES (:title, :author, :genre_id, :published_date, :created_by)");
    $stmt->execute([
        'title' => $title,
        'author' => $author,
        'genre_id' => $genre_id,
        'published_date' => $published_date,
        'created_by' => $_SESSION['user_id']
    ]);

    // Redirect back to the index page after successful insertion
    header('Location: index.php');
    exit;
}

include '../theme/header.php';

// Fetch genres for the dropdown list
$stmt = $pdo->query("SELECT * FROM genres");
$genres = $stmt->fetchAll();
?>

<h2>Add a New Book</h2>

<form method="POST">
    <label for="title">Book Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="author">Author:</label>
    <input type="text" name="author" id="author" required>

    <label for="genre_id">Genre:</label>
    <select name="genre_id" id="genre_id" required>
        <?php foreach ($genres as $genre): ?>
            <option value="<?php echo $genre['id']; ?>"><?php echo htmlspecialchars($genre['name']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="published_date">Published Date:</label>
    <input type="date" name="published_date" id="published_date">

    <button type="submit">Add Book</button>
</form>

<?php include '../theme/footer.php'; ?>

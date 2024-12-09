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
    $director = htmlspecialchars($_POST['director']);
    $genre_id = (int)$_POST['genre_id'];
    $release_date = $_POST['release_date'];

    // Insert data into the database
    $stmt = $pdo->prepare("INSERT INTO movies (title, director, genre_id, release_date, created_by)
                           VALUES (:title, :director, :genre_id, :release_date, :created_by)");
    $stmt->execute([
        'title' => $title,
        'director' => $director,
        'genre_id' => $genre_id,
        'release_date' => $release_date,
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

<h2>Add a New Movie</h2>

<form method="POST">
    <label for="title">Movie Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="director">Director:</label>
    <input type="text" name="director" id="director" required>

    <label for="genre_id">Genre:</label>
    <select name="genre_id" id="genre_id" required>
        <?php foreach ($genres as $genre): ?>
            <option value="<?php echo $genre['id']; ?>"><?php echo htmlspecialchars($genre['name']); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="release_date">Release Date:</label>
    <input type="date" name="release_date" id="release_date">

    <button type="submit">Add Movie</button>
</form>

<?php include '../theme/footer.php'; ?>

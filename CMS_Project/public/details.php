<?php
require_once '../includes/database.php';
include '../theme/header.php';

// Get the table name and ID from the URL parameters
if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = (int)$_GET['id']; // Ensure it's an integer
    $type = htmlspecialchars($_GET['type']); // Entity type (e.g., books, movies, etc.)

    // Fetch the data based on entity type and ID
    $stmt = $pdo->prepare("SELECT * FROM $type WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch();

    // Check if record exists
    if ($row) {
        $title = htmlspecialchars($row['title'] ?? $row['name']);
        $description = htmlspecialchars($row['description'] ?? 'No description available');
        $created_at = $row['created_at'];

        // Display the content based on the entity type
        if ($type === 'books') {
            $author = htmlspecialchars($row['author']);
            echo "<h2>Book: $title</h2><p><strong>Author:</strong> $author</p><p><strong>Description:</strong> $description</p>";
        } elseif ($type === 'movies') {
            $director = htmlspecialchars($row['director']);
            echo "<h2>Movie: $title</h2><p><strong>Director:</strong> $director</p><p><strong>Description:</strong> $description</p>";
        } elseif ($type === 'recipes' || $type === 'events' || $type === 'projects') {
            echo "<h2>$type: $title</h2><p><strong>Description:</strong> $description</p>";
        } else {
            echo "<h2>$type: $title</h2><p><strong>Description:</strong> $description</p>";
        }
        echo "<p><small>Created at: $created_at</small></p>";
    } else {
        echo "<p>Entity not found!</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}

include '../theme/footer.php';
?>

<?php
require_once '../includes/database.php';
include '../theme/header.php';

$entities = [
    'books' => 'Books',
    'recipes' => 'Recipes',
    'events' => 'Events',
    'projects' => 'Projects',
    'movies' => 'Movies'
];

echo "<h2>Explore Our Collection</h2>";

foreach ($entities as $table => $label) {
    echo "<section>";
    echo "<h2>$label</h2>";
    echo "<div class='card-container'>";

    // Query to fetch records from the database
    $stmt = $pdo->query("SELECT * FROM $table ORDER BY created_at DESC LIMIT 5");

    while ($row = $stmt->fetch()) {
        // For books, display author; for movies, display director; for other entities, use description
        if ($table === 'books') {
            $title = htmlspecialchars($row['title']);
            $author = htmlspecialchars($row['author']);
            $description = "Author: $author";
        } elseif ($table === 'movies') {
            $title = htmlspecialchars($row['title']);
            $director = htmlspecialchars($row['director']);
            $description = "Director: $director";
        } else {
            $title = htmlspecialchars($row['name']);
            $description = htmlspecialchars(substr($row['description'], 0, 100)) . '...';
        }

        // Display the card
        echo "<div class='card'>";
        echo "<h3>$title</h3>";
        echo "<p>$description</p>";
        echo "<form action='details.php' method='get'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='hidden' name='type' value='" . $table . "'>";
        echo "<button type='submit'>Details</button>";
        echo "</form>";
        echo "</div>";
    }

    echo "</div>";
    echo "</section>";
}

include '../theme/footer.php';
?>

<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

require_once '../includes/database.php';
include '../theme/header.php';
?>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! This is your admin dashboard.</h2>

<h3>All Movies</h3>
<a href="add_movie.php"><button>Add New Movie</button></a>
<?php
// Fetch all movies
$stmt = $pdo->prepare("SELECT * FROM movies");
$stmt->execute();
$movies = $stmt->fetchAll();

if ($movies) {
    echo "<ul>";
    foreach ($movies as $movie) {
        echo "<li><strong>" . htmlspecialchars($movie['title']) . "</strong> (Directed by: " . htmlspecialchars($movie['director']) . ")
              - <a href='details.php?entity=movie&id=" . $movie['id'] . "'>View Details</a>
              - <a href='edit_movie.php?id=" . $movie['id'] . "'>Edit</a>
              - <a href='delete_movie.php?id=" . $movie['id'] . "'>Delete</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No movies found. You can add a new movie above.</p>";
}
?>

<h3>All Books</h3>
<a href="add_book.php"><button>Add New Book</button></a>
<?php
// Fetch all books
$stmt = $pdo->prepare("SELECT * FROM books");
$stmt->execute();
$books = $stmt->fetchAll();

if ($books) {
    echo "<ul>";
    foreach ($books as $book) {
        echo "<li><strong>" . htmlspecialchars($book['title']) . "</strong> (Author: " . htmlspecialchars($book['author']) . ")
              - <a href='details.php?entity=book&id=" . $book['id'] . "'>View Details</a>
              - <a href='edit_book.php?id=" . $book['id'] . "'>Edit</a>
              - <a href='delete_book.php?id=" . $book['id'] . "'>Delete</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No books found. You can add a new book above.</p>";
}
?>

<h3>All Recipes</h3>
<a href="add_recipe.php"><button>Add New Recipe</button></a>
<?php
// Fetch all recipes
$stmt = $pdo->prepare("SELECT * FROM recipes");
$stmt->execute();
$recipes = $stmt->fetchAll();

if ($recipes) {
    echo "<ul>";
    foreach ($recipes as $recipe) {
        echo "<li><strong>" . htmlspecialchars($recipe['name']) . "</strong>
              - <a href='details.php?entity=recipe&id=" . $recipe['id'] . "'>View Details</a>
              - <a href='edit_recipe.php?id=" . $recipe['id'] . "'>Edit</a>
              - <a href='delete_recipe.php?id=" . $recipe['id'] . "'>Delete</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No recipes found. You can add a new recipe above.</p>";
}
?>

<h3>All Events</h3>
<a href="add_event.php"><button>Add New Event</button></a>
<?php
// Fetch all events
$stmt = $pdo->prepare("SELECT * FROM events");
$stmt->execute();
$events = $stmt->fetchAll();

if ($events) {
    echo "<ul>";
    foreach ($events as $event) {
        echo "<li><strong>" . htmlspecialchars($event['name']) . "</strong>
              - <a href='details.php?entity=event&id=" . $event['id'] . "'>View Details</a>
              - <a href='edit_event.php?id=" . $event['id'] . "'>Edit</a>
              - <a href='delete_event.php?id=" . $event['id'] . "'>Delete</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No events found. You can add a new event above.</p>";
}
?>

<h3>All Projects</h3>
<a href="add_project.php"><button>Add New Project</button></a>
<?php
// Fetch all projects
$stmt = $pdo->prepare("SELECT * FROM projects");
$stmt->execute();
$projects = $stmt->fetchAll();

if ($projects) {
    echo "<ul>";
    foreach ($projects as $project) {
        echo "<li><strong>" . htmlspecialchars($project['name']) . "</strong>
              - <a href='details.php?entity=project&id=" . $project['id'] . "'>View Details</a>
              - <a href='edit_project.php?id=" . $project['id'] . "'>Edit</a>
              - <a href='delete_project.php?id=" . $project['id'] . "'>Delete</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No projects found. You can add a new project above.</p>";
}
?>

<?php include '../theme/footer.php'; ?>

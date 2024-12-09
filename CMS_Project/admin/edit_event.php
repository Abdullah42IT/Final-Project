<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

require_once '../includes/database.php';

// Get the event id from URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Fetch the event details from the database
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $event = $stmt->fetch();

    // If the event doesn't exist, redirect back to the list
    if (!$event) {
        header('Location: index.php');
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $date = htmlspecialchars($_POST['date']);
        $location = htmlspecialchars($_POST['location']);
        $description = htmlspecialchars($_POST['description']);

        // Update the event in the database
        $stmt = $pdo->prepare("UPDATE events SET name = :name, date = :date, location = :location, description = :description WHERE id = :id");
        $stmt->execute(['name' => $name, 'date' => $date, 'location' => $location, 'description' => $description, 'id' => $id]);

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

<h2>Edit Event</h2>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($event['name']); ?>" required><br>

    <label>Date:</label><br>
    <input type="date" name="date" value="<?php echo htmlspecialchars($event['date']); ?>" required><br>

    <label>Location:</label><br>
    <input type="text" name="location" value="<?php echo htmlspecialchars($event['location']); ?>" required><br>

    <label>Description:</label><br>
    <textarea name="description" required><?php echo htmlspecialchars($event['description']); ?></textarea><br>

    <button type="submit">Update Event</button>
</form>

<a href="index.php">Back to Admin Dashboard</a>

<?php include '../theme/footer.php'; ?>

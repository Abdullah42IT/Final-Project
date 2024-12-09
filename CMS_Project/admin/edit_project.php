<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

require_once '../includes/database.php';

// Get the project id from URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Fetch the project details from the database
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $project = $stmt->fetch();

    // If the project doesn't exist, redirect back to the list
    if (!$project) {
        header('Location: index.php');
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $start_date = htmlspecialchars($_POST['start_date']);
        $end_date = htmlspecialchars($_POST['end_date']);
        $description = htmlspecialchars($_POST['description']);

        // Update the project in the database
        $stmt = $pdo->prepare("UPDATE projects SET name = :name, start_date = :start_date, end_date = :end_date, description = :description WHERE id = :id");
        $stmt->execute(['name' => $name, 'start_date' => $start_date, 'end_date' => $end_date, 'description' => $description, 'id' => $id]);

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

<h2>Edit Project</h2>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($project['name']); ?>" required><br>

    <label>Start Date:</label><br>
    <input type="date" name="start_date" value="<?php echo htmlspecialchars($project['start_date']); ?>" required><br>

    <label>End Date:</label><br>
    <input type="date" name="end_date" value="<?php echo htmlspecialchars($project['end_date']); ?>" required><br>

    <label>Description:</label><br>
    <textarea name="description" required><?php echo htmlspecialchars($project['description']); ?></textarea><br>

    <button type="submit">Update Project</button>
</form>

<a href="index.php">Back to Admin Dashboard</a>

<?php include '../theme/footer.php'; ?>

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

    // Delete the event from the database
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = :id");
    $stmt->execute(['id' => $id]);

    // Redirect to admin dashboard
    header('Location: index.php');
    exit;
} else {
    header('Location: index.php');
    exit;
}

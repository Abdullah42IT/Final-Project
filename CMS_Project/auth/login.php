<?php
require_once '../includes/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email and password from form
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Fetch user from database by email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // Check if user exists and the password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Start a session and store user information
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect to the appropriate page based on user role
        if ($user['role'] === 'admin') {
            header('Location: ../admin/index.php'); // Admin dashboard
        } else {
            header('Location: ../members/index.php'); // Member dashboard
        }
        exit;
    } else {
        $error = "Invalid credentials. Please try again.";
    }
}

include '../theme/header.php';
?>

<h2>Login</h2>

<?php
// Show error if there is any
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>

<form method="POST" action="">
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="/auth/signup.php">Sign up here</a></p>

<?php include '../theme/footer.php'; ?>

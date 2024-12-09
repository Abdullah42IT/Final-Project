<?php
require_once '../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from the form
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        $error = "Email already registered. Please use a different email.";
    } else {
        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, 'user')");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        // Redirect to login page after successful sign up
        header('Location: /auth/login.php');
        exit;
    }
}

include '../theme/header.php';
?>

<h2>Sign Up</h2>

<?php
// Show error if there is any
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>

<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br>
    <button type="submit">Sign Up</button>
</form>

<p>Already have an account? <a href="/auth/login.php">Log in here</a></p>

<?php include '../theme/footer.php'; ?>

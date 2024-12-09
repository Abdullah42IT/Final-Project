<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Project</title>
    <link rel="stylesheet" href="../theme/css/style.css">
</head>
<body>
    <header>
        <h1>CMS Project</h1>
        <nav>
            <a href="../public/index.php">Home</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <!-- Admin specific links -->
                    <a href="../admin/index.php">Admin Dashboard</a>
                    <a href="../auth/logout.php">Log Out</a>
                <?php else: ?>
                    <!-- User specific links -->
                    <a href="../auth/logout.php">Log Out</a>
                <?php endif; ?>
            <?php else: ?>
                <!-- Not logged in -->
                <a href="../auth/login.php">Login</a>
                <a href="../auth/signup.php">Sign Up</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit;
}

require_once '../includes/database.php';

// Ensure both entity and id are set in the URL
if (isset($_GET['entity']) && isset($_GET['id'])) {
    $entity = htmlspecialchars($_GET['entity']);
    $id = (int)$_GET['id'];

    // Validate entity type
    $valid_entities = ['movie', 'book', 'recipe', 'event', 'project'];
    if (!in_array($entity, $valid_entities)) {
        echo "Invalid entity type!";
        exit;
    }

    // Fetch details based on the entity type
    switch ($entity) {
        case 'movie':
            $stmt = $pdo->prepare("SELECT * FROM movies WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch();
            break;
        case 'book':
            $stmt = $pdo->prepare("SELECT * FROM books WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch();
            break;
        case 'recipe':
            $stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch();
            break;
        case 'event':
            $stmt = $pdo->prepare("SELECT * FROM events WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch();
            break;
        case 'project':
            $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch();
            break;
        default:
            echo "Invalid entity!";
            exit;
    }

    // If no data found
    if (!$data) {
        echo "No data found for the selected entity.";
        exit;
    }

    include '../theme/header.php';
    ?>
    <h2><?php echo ucfirst($entity); ?> Details</h2>

    <table>
        <?php foreach ($data as $key => $value): ?>
            <tr>
                <th><?php echo ucfirst(str_replace('_', ' ', $key)); ?></th>
                <td><?php echo htmlspecialchars($value); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="index.php">Back to Member Dashboard</a>

    <?php
    include '../theme/footer.php';
} else {
    echo "Invalid request!";
}
?>

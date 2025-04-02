<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Validate input
        if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $role, $id]);
            header("Location: view.php");
            exit;
        } else {
            $error = "Invalid input!";
        }
    }
} else {
    header("Location: view.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="edit.php?id=<?php echo $user['id']; ?>" method="POST">
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>
        <select name="role">
            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
        </select><br><br>
        <button type="submit">Update User</button>
    </form>
    <br>
    <a href="view.php">Back to User List</a>
</body>
</html>

<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Validate input
    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "INSERT INTO users (name, email, role) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $role]);
        header("Location: view.php");
        exit;
    } else {
        $error = "Invalid input!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
</head>
<body>
    <h2>Add New User</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="create.php" method="POST">
        <input type="text" name="name" placeholder="Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br><br>
        <button type="submit">Add User</button>
    </form>
    <br>
    <a href="view.php">Back to User List</a>
</body>
</html>

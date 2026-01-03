<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $student_id = $_POST['student_id'];
    $full_name  = $_POST['name'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO students (student_id, full_name, password_hash)
            VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$student_id, $full_name, $password]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST">
    Student ID: <input type="text" name="student_id" required><br><br>
    Name: <input type="text" name="name" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>

</body>
</html>

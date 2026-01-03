<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $student_id = $_POST['student_id'] ?? '';
    $password   = $_POST['password'] ?? '';

    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$student_id]);
    $student = $stmt->fetch();

    if ($student && password_verify($password, $student['password_hash'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $student['name'];

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid Student ID or Password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">
    Student ID: <input type="text" name="student_id" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

</body>
</html>

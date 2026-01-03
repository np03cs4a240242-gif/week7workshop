<?php
session_start();

/* Check login */
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

/* Read theme cookie */
$theme = $_COOKIE['theme'] ?? 'light';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="<?= htmlspecialchars($theme) ?>">

<h1>Welcome</h1>

<p>Current Theme: <strong><?= ucfirst($theme) ?> Mode</strong></p>

<a href="preference.php">Change Theme</a><br><br>

<form method="POST" action="logout.php">
    <button type="submit">Logout</button>
</form>

</body>
</html>

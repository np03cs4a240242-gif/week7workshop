<?php
session_start();

/* 1. Redirect if not logged in */
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

/* 2. Handle form submission */
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $theme = $_POST['theme'];

    /* 3. Whitelist theme values */
    if (in_array($theme, ['light', 'dark'])) {
        setcookie('theme', $theme, time() + 86400 * 30, "/"); // 30 days
    }

    /* 4. Refresh page to apply theme immediately */
    header("Location: preference.php");
    exit;
}

/* 5. Get current theme for display */
$currentTheme = $_COOKIE['theme'] ?? 'light';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Theme Preference</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?= htmlspecialchars($currentTheme) ?>">

<h2>Select Your Theme</h2>

<form method="POST">
    <label for="theme">Theme:</label>
    <select name="theme" id="theme">
        <option value="light" <?= $currentTheme === 'light' ? 'selected' : '' ?>>Light Mode</option>
        <option value="dark" <?= $currentTheme === 'dark' ? 'selected' : '' ?>>Dark Mode</option>
    </select><br><br>
    <button type="submit">Save Preference</button>
</form>

<br>
<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>

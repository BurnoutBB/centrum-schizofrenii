<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<h1>Witaj w Dashboardzie!</h1>
<p>Zalogowany użytkownik (ID): <?php echo $user_id; ?></p>
<a href="logout.php">Wyloguj się</a>

</body>
</html>
<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "uzytkownicy");
    if ($conn->connect_error) {
        die("Błąd połączenia z bazą danych: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id_uzytkownika, Nazwa_uzytkownika, haslo FROM logowanie WHERE Nazwa_uzytkownika = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $db_username, $db_password);
        $stmt->fetch();

        // Porównaj hasła
        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Nieprawidłowe hasło";
        }
    } else {
        $error = "Nieprawidłowa nazwa użytkownika";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
</head>
<body>

<h1>System Logowania</h1>

<?php if (isset($error)) : ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="">
    <label for="username">Użytkownik:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Hasło:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <input type="submit" value="Zaloguj">
</form>

</body>
</html>
